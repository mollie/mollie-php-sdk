# CheckoutSessions

## Overview

### Available Operations

* [create](#create) - Create Checkout Session
* [get](#get) - Get Checkout Session

## create

> 🚧 Beta feature
>
> This feature is currently in beta.
>
> The `shipping` and `requiredCustomerDetails` properties are still in private beta.

Create a Checkout Session to start a checkout process with Mollie Components.

### Example Usage: create-session-201-1

<!-- UsageSnippet language="php" operationID="create-session" method="post" path="/v2/sessions" example="create-session-201-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\SessionRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Order #12345',
    lines: [],
    redirectUrl: 'https://example.org/redirect',
    requiredCustomerDetails: [
        Components\SessionRequiredCustomerDetails::BillingAddress,
    ],
    billingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shippingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shipping: new Components\SessionRequestShipping1(
        options: [
            new Components\SessionRequestOption1(
                description: 'Next day delivery',
                reference: 'express',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
            ),
        ],
        callbackUrl: 'https://example.org/shipping-options',
    ),
    customerId: 'cst_5B8cwPMGnU',
    sequenceType: Components\SessionSequenceType::Oneoff,
    payment: new Components\SessionRequestPayment(
        webhookUrl: 'https://example.org/webhook',
    ),
    profileId: 'pfl_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->checkoutSessions->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->sessionResponse !== null) {
    // handle response
}
```
### Example Usage: create-session-201-2

<!-- UsageSnippet language="php" operationID="create-session" method="post" path="/v2/sessions" example="create-session-201-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\SessionRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Order #12345',
    lines: [],
    redirectUrl: 'https://example.org/redirect',
    requiredCustomerDetails: [
        Components\SessionRequiredCustomerDetails::BillingAddress,
    ],
    billingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shippingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shipping: new Components\SessionRequestShipping1(
        options: [
            new Components\SessionRequestOption1(
                description: 'Next day delivery',
                reference: 'express',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
            ),
        ],
        callbackUrl: 'https://example.org/shipping-options',
    ),
    customerId: 'cst_5B8cwPMGnU',
    sequenceType: Components\SessionSequenceType::Oneoff,
    payment: new Components\SessionRequestPayment(
        webhookUrl: 'https://example.org/webhook',
    ),
    profileId: 'pfl_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->checkoutSessions->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->sessionResponse !== null) {
    // handle response
}
```
### Example Usage: create-session-201-3

<!-- UsageSnippet language="php" operationID="create-session" method="post" path="/v2/sessions" example="create-session-201-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\SessionRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Order #12345',
    lines: [],
    redirectUrl: 'https://example.org/redirect',
    requiredCustomerDetails: [
        Components\SessionRequiredCustomerDetails::BillingAddress,
    ],
    billingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shippingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shipping: new Components\SessionRequestShipping1(
        options: [
            new Components\SessionRequestOption1(
                description: 'Next day delivery',
                reference: 'express',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
            ),
        ],
        callbackUrl: 'https://example.org/shipping-options',
    ),
    customerId: 'cst_5B8cwPMGnU',
    sequenceType: Components\SessionSequenceType::Oneoff,
    payment: new Components\SessionRequestPayment(
        webhookUrl: 'https://example.org/webhook',
    ),
    profileId: 'pfl_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->checkoutSessions->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->sessionResponse !== null) {
    // handle response
}
```
### Example Usage: create-session-201-4

<!-- UsageSnippet language="php" operationID="create-session" method="post" path="/v2/sessions" example="create-session-201-4" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\SessionRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Order #12345',
    lines: [],
    redirectUrl: 'https://example.org/redirect',
    requiredCustomerDetails: [
        Components\SessionRequiredCustomerDetails::BillingAddress,
    ],
    billingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shippingAddress: new Components\PaymentAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
        organizationName: 'Mollie B.V.',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: 'Apt. 1',
        postalCode: '1234AB',
        email: 'piet@example.org',
        phone: '31208202070',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
    ),
    shipping: new Components\SessionRequestShipping1(
        options: [
            new Components\SessionRequestOption1(
                description: 'Next day delivery',
                reference: 'express',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
            ),
        ],
        callbackUrl: 'https://example.org/shipping-options',
    ),
    customerId: 'cst_5B8cwPMGnU',
    sequenceType: Components\SessionSequenceType::Oneoff,
    payment: new Components\SessionRequestPayment(
        webhookUrl: 'https://example.org/webhook',
    ),
    profileId: 'pfl_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->checkoutSessions->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->sessionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                               | Type                                                                                                                                                                                    | Required                                                                                                                                                                                | Description                                                                                                                                                                             | Example                                                                                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                                                                                                        | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                                             |
| `xClientSignature`                                                                                                                                                                      | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A cryptographic signature of the request, used to verify that it was sent by you and hasn't been tampered with. Required if you've enabled request signing for your integration.        | MEUCIQDx8sJvK3z...                                                                                                                                                                      |
| `xClientSignedAt`                                                                                                                                                                       | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | The timestamp, in ISO 8601 format, at which you generated the `X-Client-Signature`. Required together with `X-Client-Signature` if you've enabled request signing for your integration. | 2025-01-01T12:00:00Z                                                                                                                                                                    |
| `body`                                                                                                                                                                                  | [?Components\SessionRequest](../../Models/Components/SessionRequest.md)                                                                                                                 | :heavy_minus_sign:                                                                                                                                                                      | N/A                                                                                                                                                                                     |                                                                                                                                                                                         |

### Response

**[?Operations\CreateSessionResponse](../../Models/Operations/CreateSessionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

> 🚧 Beta feature
>
> This feature is currently in beta.
>
> The `shipping` and `requiredCustomerDetails` properties are still in private beta.

Retrieve a Checkout Session to view its details and status to inform your customers about the checkout process.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-session" method="get" path="/v2/sessions/{sessionId}" example="get-session-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->checkoutSessions->get(
    sessionId: 'sess_82jFYDTrLcCQV68NLDvMJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z'

);

if ($response->sessionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                               | Type                                                                                                                                                                                    | Required                                                                                                                                                                                | Description                                                                                                                                                                             | Example                                                                                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `sessionId`                                                                                                                                                                             | *string*                                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                                      | Provide the ID of the related Checkout Session.                                                                                                                                         | sess_82jFYDTrLcCQV68NLDvMJ                                                                                                                                                              |
| `idempotencyKey`                                                                                                                                                                        | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                                             |
| `xClientSignature`                                                                                                                                                                      | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A cryptographic signature of the request, used to verify that it was sent by you and hasn't been tampered with. Required if you've enabled request signing for your integration.        | MEUCIQDx8sJvK3z...                                                                                                                                                                      |
| `xClientSignedAt`                                                                                                                                                                       | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | The timestamp, in ISO 8601 format, at which you generated the `X-Client-Signature`. Required together with `X-Client-Signature` if you've enabled request signing for your integration. | 2025-01-01T12:00:00Z                                                                                                                                                                    |

### Response

**[?Operations\GetSessionResponse](../../Models/Operations/GetSessionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |