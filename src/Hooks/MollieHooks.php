<?php

declare(strict_types=1);

namespace Mollie\Api\Hooks;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Utils as Psr7Utils;
use Mollie\Api\SDKConfiguration;
use Psr\Http\Message\RequestInterface;

/**
 * Custom hook ported from Mollie's other generated SDKs (see mollie-api-py's
 * MollieHooks). It validates path parameters, auto-generates an idempotency
 * key, appends a custom User-Agent suffix, and injects global fields
 * (profileId/testmode) into the request body for operations that support
 * them.
 *
 * Speakeasy's generated PHP resource methods call `beforeRequest()` with a
 * blank PSR-7 request (no headers, no body yet) and only merge the caller's
 * real headers/body into it afterwards. That means idempotency-key handling
 * and body-field injection can't safely happen in `beforeRequest()` alone:
 * doing so there would either clobber a caller-supplied idempotency key or
 * operate on an always-empty body. Instead, `beforeRequest()` only tags the
 * request with short-lived internal headers, and an `SDKInitHook`-installed
 * Guzzle middleware (which sees the fully-merged, final request on every
 * real send attempt, including retries) reads those tags, strips them, and
 * performs the actual idempotency-key and global-field logic.
 */
class MollieHooks implements BeforeRequestHook, SDKInitHook
{
    private const FALLBACK_IDEMPOTENCY_KEY_HEADER = 'x-mollie-sdk-fallback-idempotency-key';

    private const OPERATION_ID_HEADER = 'x-mollie-sdk-operation-id';

    /** @var array<string, array<int, string>> */
    private array $globalUsage;

    private ?SDKConfiguration $config = null;

    public function __construct()
    {
        $this->globalUsage = GlobalUsage::load();
    }

    public function beforeRequest(BeforeRequestContext $context, RequestInterface $request): RequestInterface
    {
        $this->validatePathParameters($request);

        $request = $this->customizeUserAgent($request, $context);

        // Generated once per logical call (not per retry attempt), so the
        // fallback stays stable across retries of the same request.
        $request = $request->withHeader(self::FALLBACK_IDEMPOTENCY_KEY_HEADER, $this->generateIdempotencyKey());

        if ($this->canInjectGlobalFields($context)) {
            $request = $request->withHeader(self::OPERATION_ID_HEADER, $context->operationID);
        }

        return $request;
    }

    public function sdkInit(SDKConfiguration $config): SDKConfiguration
    {
        $this->config = $config;

        $config->defaultClient = $this->wrapClientWithMiddleware(
            $config->defaultClient ?? $config->client ?? new GuzzleClient(['timeout' => 60])
        );

        // Most resource classes send requests via `defaultClient` (re-wrapping it
        // for security per call), but Oauth.php sends directly via `client`. Wrap
        // it too when it's a plain Guzzle client; if it's already been wrapped for
        // security (an instance Speakeasy's own SecurityClient), leave it alone
        // rather than risk breaking it - OAuth endpoints don't use idempotency
        // keys or global fields anyway.
        if ($config->client instanceof GuzzleClient) {
            $config->client = $this->wrapClientWithMiddleware($config->client);
        }

        return $config;
    }

    private function validatePathParameters(RequestInterface $request): void
    {
        $path = $request->getUri()->getPath();
        $segments = explode('/', $path);

        foreach ($segments as $index => $segment) {
            if ($index === 0 && $segment === '') {
                continue;
            }

            if (trim($segment) === '') {
                throw new \InvalidArgumentException(
                    sprintf("Invalid request: empty path parameter detected in [%s] '%s'", $request->getMethod(), $path)
                );
            }
        }
    }

    private function generateIdempotencyKey(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0F | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    private function customizeUserAgent(RequestInterface $request, BeforeRequestContext $context): RequestInterface
    {
        $customUserAgent = $this->flattenGlobals($context->config)['customUserAgent'] ?? null;

        if (! is_string($customUserAgent) || $customUserAgent === '') {
            return $request;
        }

        $userAgent = $request->getHeaderLine('user-agent');
        if ($userAgent === '') {
            $userAgent = $context->config->userAgent;
        }

        return $request->withHeader('user-agent', trim($userAgent.' '.$customUserAgent));
    }

    private function canInjectGlobalFields(BeforeRequestContext $context): bool
    {
        if (empty($this->globalUsage) || ! $context->config->hasSecurity()) {
            return false;
        }

        $security = $context->config->getSecurity();

        // Global field injection into the body is only supported for Access Token
        // based authentication (API keys / advanced access tokens), not for OAuth.
        return $security->oAuth === null && ($security->apiKey !== null || $security->advancedAccessToken !== null);
    }

    /**
     * Wraps a plain Guzzle client with a middleware that finalizes the
     * idempotency key and injects global fields on the fully-merged request.
     * Non-Guzzle `ClientInterface` implementations (e.g. test doubles, or a
     * client Speakeasy has already wrapped for security) are returned as-is
     * rather than risk breaking them.
     */
    private function wrapClientWithMiddleware(GuzzleClientInterface $client): GuzzleClientInterface
    {
        if (! $client instanceof GuzzleClient) {
            return $client;
        }

        $clientConfig = $client->getConfig();
        $handlerStack = $clientConfig['handler'] ?? null;

        if (! $handlerStack instanceof HandlerStack) {
            $handlerStack = HandlerStack::create($handlerStack);
        }

        $handlerStack->push($this->middleware(), 'mollie-request-finalizer');
        $clientConfig['handler'] = $handlerStack;

        return new GuzzleClient($clientConfig);
    }

    private function middleware(): callable
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $this->applyIdempotencyKeyFallback($request);
                $request = $this->finalizeGlobalFieldInjection($request);

                return $handler($request, $options);
            };
        };
    }

    private function applyIdempotencyKeyFallback(RequestInterface $request): RequestInterface
    {
        $fallback = $request->getHeaderLine(self::FALLBACK_IDEMPOTENCY_KEY_HEADER);
        $request = $request->withoutHeader(self::FALLBACK_IDEMPOTENCY_KEY_HEADER);

        if ($fallback === '') {
            return $request;
        }

        if ($request->hasHeader('idempotency-key') && $request->getHeaderLine('idempotency-key') !== '') {
            return $request;
        }

        return $request->withHeader('idempotency-key', $fallback);
    }

    private function finalizeGlobalFieldInjection(RequestInterface $request): RequestInterface
    {
        $operationId = $request->getHeaderLine(self::OPERATION_ID_HEADER);
        $request = $request->withoutHeader(self::OPERATION_ID_HEADER);

        if ($operationId === '' || $this->config === null) {
            return $request;
        }

        $globals = $this->flattenGlobals($this->config);

        $fieldsToInject = [];
        foreach ($this->globalUsage as $field => $operations) {
            if (in_array($operationId, $operations, true) && array_key_exists($field, $globals)) {
                $fieldsToInject[$field] = $globals[$field];
            }
        }

        if (empty($fieldsToInject)) {
            return $request;
        }

        $content = (string) $request->getBody();
        $body = $content !== '' ? json_decode($content, true) : [];

        if (! is_array($body)) {
            return $request;
        }

        foreach ($fieldsToInject as $field => $value) {
            if (! array_key_exists($field, $body)) {
                $body[$field] = $value;
            }
        }

        $newContent = (string) json_encode($body);

        return $request
            ->withBody(Psr7Utils::streamFor($newContent))
            ->withHeader('content-length', (string) strlen($newContent));
    }

    /**
     * Flattens the SDK's globals (stored per parameter location: queryParam,
     * header, body, ...) into a single field-name => value lookup, since
     * global field names are unique across locations.
     *
     * @return array<string, mixed>
     */
    private function flattenGlobals(SDKConfiguration $config): array
    {
        $parameters = $config->globals['parameters'] ?? [];
        $flat = [];

        foreach ($parameters as $fields) {
            foreach ($fields as $name => $value) {
                $flat[$name] = $value;
            }
        }

        return $flat;
    }
}
