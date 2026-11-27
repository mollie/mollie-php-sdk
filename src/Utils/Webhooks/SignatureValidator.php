<?php

declare(strict_types=1);

namespace Mollie\Api\Utils\Webhooks;

/**
 * Validates Mollie webhook signatures using HMAC-SHA256.
 *
 * Ported from the sibling mollie-api-py SDK's SignatureValidator.
 */
class SignatureValidator
{
    public const SIGNATURE_HEADER = 'X-Mollie-Signature';

    private const SIGNATURE_PREFIX = 'sha256=';

    /** @var string[] */
    private array $signingSecrets;

    /**
     * @param  string|string[]  $signingSecrets  One or more signing secrets (supports multiple for migration periods).
     */
    public function __construct(string|array $signingSecrets)
    {
        $this->signingSecrets = is_string($signingSecrets) ? [$signingSecrets] : array_values($signingSecrets);
    }

    /**
     * Static helper for simpler usage.
     *
     * @param  string  $payload  Raw request body as a string.
     * @param  string|string[]  $signingSecrets  One or more signing secrets.
     * @param  string|string[]|null  $signatures  One or more signatures to validate against.
     * @return bool  True if a valid signature is found, false if legacy webhook (no signature).
     *
     * @throws InvalidSignatureException  If all signatures are invalid.
     */
    public static function validate(string $payload, string|array $signingSecrets, string|array|null $signatures = null): bool
    {
        return (new self($signingSecrets))->validatePayload($payload, $signatures);
    }

    /**
     * Verify a raw webhook payload against the provided signature(s).
     *
     * @param  string  $payload  Raw request body as a string.
     * @param  string|string[]|null  $signatures  One or more signatures to validate against.
     * @return bool  True if any signature is valid, false if no signatures were provided (legacy webhook).
     *
     * @throws InvalidSignatureException  If all signatures are invalid.
     */
    public function validatePayload(string $payload, string|array|null $signatures): bool
    {
        if (is_string($signatures)) {
            $signatures = $signatures !== '' ? [$signatures] : [];
        } elseif ($signatures === null) {
            $signatures = [];
        }

        $signatures = array_values(array_filter($signatures, fn ($signature) => $signature !== ''));

        if (empty($signatures)) {
            return false;
        }

        return $this->validateSignatures($payload, $signatures);
    }

    /**
     * @param  string[]  $signatures
     */
    private function validateSignatures(string $payload, array $signatures): bool
    {
        $validSignatureFound = false;

        foreach ($signatures as $signature) {
            if ($this->isValidSignature($this->extractSignature($signature), $payload)) {
                $validSignatureFound = true;
                break;
            }
        }

        if (! $validSignatureFound) {
            throw new InvalidSignatureException('Invalid webhook signature');
        }

        return true;
    }

    private function extractSignature(string $signatureHeader): string
    {
        if (str_starts_with($signatureHeader, self::SIGNATURE_PREFIX)) {
            return substr($signatureHeader, strlen(self::SIGNATURE_PREFIX));
        }

        return $signatureHeader;
    }

    private function isValidSignature(string $providedSignature, string $payload): bool
    {
        foreach ($this->signingSecrets as $secret) {
            if (hash_equals(self::createSignature($payload, $secret), $providedSignature)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create an HMAC-SHA256 signature for a given payload and secret.
     */
    public static function createSignature(string $payload, string $secret): string
    {
        return hash_hmac('sha256', $payload, $secret);
    }
}
