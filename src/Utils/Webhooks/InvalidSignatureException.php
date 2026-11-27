<?php

declare(strict_types=1);

namespace Mollie\Api\Utils\Webhooks;

/**
 * Thrown by SignatureValidator when none of the provided webhook signatures
 * match the expected HMAC signature.
 */
class InvalidSignatureException extends \Exception
{
}
