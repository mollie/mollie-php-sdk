<?php

declare(strict_types=1);

namespace Mollie\Api\Hooks;

use GuzzleHttp\Psr7\Utils as Psr7Utils;
use Psr\Http\Message\RequestInterface;

/**
 * Custom before-request hook ported from Mollie's other generated SDKs (see
 * mollie-api-py's MollieHooks). It validates path parameters, auto-generates
 * an idempotency key, appends a custom User-Agent suffix, and injects global
 * fields (profileId/testmode) into the request body for operations that
 * support them.
 */
class MollieHooks implements BeforeRequestHook
{
    /** @var array<string, array<int, string>> */
    private array $globalUsage;

    public function __construct()
    {
        $this->globalUsage = GlobalUsage::load();
    }

    public function beforeRequest(BeforeRequestContext $context, RequestInterface $request): RequestInterface
    {
        $this->validatePathParameters($request);

        $request = $this->handleIdempotencyKey($request);
        $request = $this->customizeUserAgent($request, $context);

        if ($this->canInjectGlobalFields($context)) {
            $request = $this->injectGlobalFields($request, $context);
        }

        return $request;
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

    private function handleIdempotencyKey(RequestInterface $request): RequestInterface
    {
        if ($request->hasHeader('idempotency-key') && $request->getHeaderLine('idempotency-key') !== '') {
            return $request;
        }

        return $request->withHeader('idempotency-key', $this->generateIdempotencyKey());
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
        $customUserAgent = $this->flattenGlobals($context)['customUserAgent'] ?? null;

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

    private function injectGlobalFields(RequestInterface $request, BeforeRequestContext $context): RequestInterface
    {
        $operationId = $context->operationID;
        $globals = $this->flattenGlobals($context);

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
    private function flattenGlobals(BeforeRequestContext $context): array
    {
        $parameters = $context->config->globals['parameters'] ?? [];
        $flat = [];

        foreach ($parameters as $fields) {
            foreach ($fields as $name => $value) {
                $flat[$name] = $value;
            }
        }

        return $flat;
    }
}
