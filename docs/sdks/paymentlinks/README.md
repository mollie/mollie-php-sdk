# PaymentLinks

## Overview

### Available Operations

* [create](#create) - Create payment link
* [list](#list) - List payment links
* [get](#get) - Get payment link
* [update](#update) - Update payment link
* [delete](#delete) - Delete payment link
* [listPayments](#listpayments) - Get payment link payments

## create

With the Payment links API you can generate payment links that by default, unlike regular payments, do not expire.
The payment link can be shared with your customers and will redirect them to them the payment page where they can
complete the payment. A [payment](get-payment) will only be created once the customer initiates the payment.

### Example Usage: create-payment-link-201-1

<!-- UsageSnippet language="php" operationID="create-payment-link" method="post" path="/v2/payment-links" example="create-payment-link-201-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\CreatePaymentLinkRequestBody(
    description: 'Chess Board',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    minimumAmount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://webshop.example.org/payment-links/redirect/',
    webhookUrl: 'https://webshop.example.org/payment-links/webhook/',
    lines: [
        new Components\PaymentLineItem(
            type: Components\PaymentLineType::Physical,
            description: 'LEGO 4440 Forest Police Station',
            quantity: 1,
            quantityUnit: 'pcs',
            unitPrice: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            discountAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            totalAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            vatRate: '21.00',
            vatAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            sku: '9780241661628',
            categories: [
                Components\LineCategories::Meal,
                Components\LineCategories::Eco,
            ],
            imageUrl: 'https://...',
            productUrl: 'https://...',
        ),
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
    profileId: 'pfl_QkEhN94Ba',
    reusable: false,
    expiresAt: '2025-12-24T11:00:16+00:00',
    allowedMethods: null,
    applicationFee: new Operations\ApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: 'Platform fee',
    ),
    sequenceType: Components\PaymentLinkSequenceType::Oneoff,
    customerId: 'cst_XimFHuaEzd',
    testmode: false,
);

$response = $sdk->paymentLinks->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-link-201-2

<!-- UsageSnippet language="php" operationID="create-payment-link" method="post" path="/v2/payment-links" example="create-payment-link-201-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\CreatePaymentLinkRequestBody(
    description: 'Chess Board',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    minimumAmount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://webshop.example.org/payment-links/redirect/',
    webhookUrl: 'https://webshop.example.org/payment-links/webhook/',
    lines: [
        new Components\PaymentLineItem(
            type: Components\PaymentLineType::Physical,
            description: 'LEGO 4440 Forest Police Station',
            quantity: 1,
            quantityUnit: 'pcs',
            unitPrice: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            discountAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            totalAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            vatRate: '21.00',
            vatAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            sku: '9780241661628',
            categories: [
                Components\LineCategories::Meal,
                Components\LineCategories::Eco,
            ],
            imageUrl: 'https://...',
            productUrl: 'https://...',
        ),
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
    profileId: 'pfl_QkEhN94Ba',
    reusable: false,
    expiresAt: '2025-12-24T11:00:16+00:00',
    allowedMethods: null,
    applicationFee: new Operations\ApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: 'Platform fee',
    ),
    sequenceType: Components\PaymentLinkSequenceType::Oneoff,
    customerId: 'cst_XimFHuaEzd',
    testmode: false,
);

$response = $sdk->paymentLinks->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-link-201-3

<!-- UsageSnippet language="php" operationID="create-payment-link" method="post" path="/v2/payment-links" example="create-payment-link-201-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\CreatePaymentLinkRequestBody(
    description: 'Chess Board',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    minimumAmount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://webshop.example.org/payment-links/redirect/',
    webhookUrl: 'https://webshop.example.org/payment-links/webhook/',
    lines: [
        new Components\PaymentLineItem(
            type: Components\PaymentLineType::Physical,
            description: 'LEGO 4440 Forest Police Station',
            quantity: 1,
            quantityUnit: 'pcs',
            unitPrice: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            discountAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            totalAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            vatRate: '21.00',
            vatAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            sku: '9780241661628',
            categories: [
                Components\LineCategories::Meal,
                Components\LineCategories::Eco,
            ],
            imageUrl: 'https://...',
            productUrl: 'https://...',
        ),
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
    profileId: 'pfl_QkEhN94Ba',
    reusable: false,
    expiresAt: '2025-12-24T11:00:16+00:00',
    allowedMethods: null,
    applicationFee: new Operations\ApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: 'Platform fee',
    ),
    sequenceType: Components\PaymentLinkSequenceType::Oneoff,
    customerId: 'cst_XimFHuaEzd',
    testmode: false,
);

$response = $sdk->paymentLinks->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-link-201-4

<!-- UsageSnippet language="php" operationID="create-payment-link" method="post" path="/v2/payment-links" example="create-payment-link-201-4" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\CreatePaymentLinkRequestBody(
    description: 'Chess Board',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    minimumAmount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://webshop.example.org/payment-links/redirect/',
    webhookUrl: 'https://webshop.example.org/payment-links/webhook/',
    lines: [
        new Components\PaymentLineItem(
            type: Components\PaymentLineType::Physical,
            description: 'LEGO 4440 Forest Police Station',
            quantity: 1,
            quantityUnit: 'pcs',
            unitPrice: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            discountAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            totalAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            vatRate: '21.00',
            vatAmount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            sku: '9780241661628',
            categories: [
                Components\LineCategories::Meal,
                Components\LineCategories::Eco,
            ],
            imageUrl: 'https://...',
            productUrl: 'https://...',
        ),
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
    profileId: 'pfl_QkEhN94Ba',
    reusable: false,
    expiresAt: '2025-12-24T11:00:16+00:00',
    allowedMethods: null,
    applicationFee: new Operations\ApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: 'Platform fee',
    ),
    sequenceType: Components\PaymentLinkSequenceType::Oneoff,
    customerId: 'cst_XimFHuaEzd',
    testmode: false,
);

$response = $sdk->paymentLinks->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                           | Type                                                                                                | Required                                                                                            | Description                                                                                         | Example                                                                                             |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                    | *?string*                                                                                           | :heavy_minus_sign:                                                                                  | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                    | 123e4567-e89b-12d3-a456-426                                                                         |
| `body`                                                                                              | [?Operations\CreatePaymentLinkRequestBody](../../Models/Operations/CreatePaymentLinkRequestBody.md) | :heavy_minus_sign:                                                                                  | N/A                                                                                                 |                                                                                                     |

### Response

**[?Operations\CreatePaymentLinkResponse](../../Models/Operations/CreatePaymentLinkResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all payment links.

The results are paginated.

### Example Usage: list-payment-links-200-1

<!-- UsageSnippet language="php" operationID="list-payment-links" method="get" path="/v2/payment-links" example="list-payment-links-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$responses = $sdk->paymentLinks->list(
    from: 'pl_d9fQur83kFdhH8hIhaZfq',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-payment-links-200-2

<!-- UsageSnippet language="php" operationID="list-payment-links" method="get" path="/v2/payment-links" example="list-payment-links-200-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$responses = $sdk->paymentLinks->list(
    from: 'pl_d9fQur83kFdhH8hIhaZfq',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `from`                                                                                                                                                                                                                                                                                                                                                                                   | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Provide an ID to start the result set from the item with the given ID and onwards. This allows you to paginate the<br/>result set.                                                                                                                                                                                                                                                       | pl_d9fQur83kFdhH8hIhaZfq                                                                                                                                                                                                                                                                                                                                                                 |
| `limit`                                                                                                                                                                                                                                                                                                                                                                                  | *?int*                                                                                                                                                                                                                                                                                                                                                                                   | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | The maximum number of items to return. Defaults to 50 items.                                                                                                                                                                                                                                                                                                                             | 50                                                                                                                                                                                                                                                                                                                                                                                       |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\ListPaymentLinksResponse](../../Models/Operations/ListPaymentLinksResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payment link by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-payment-link" method="get" path="/v2/payment-links/{paymentLinkId}" example="get-payment-link-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->paymentLinks->get(
    paymentLinkId: 'pl_d9fQur83kFdhH8hIhaZfq',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `paymentLinkId`                                                                                                                                                                                                                                                                                                                                                                          | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related payment link.                                                                                                                                                                                                                                                                                                                                              | pl_d9fQur83kFdhH8hIhaZfq                                                                                                                                                                                                                                                                                                                                                                 |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetPaymentLinkResponse](../../Models/Operations/GetPaymentLinkResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Certain details of an existing payment link can be updated.

### Example Usage

<!-- UsageSnippet language="php" operationID="update-payment-link" method="patch" path="/v2/payment-links/{paymentLinkId}" example="update-payment-link-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\UpdatePaymentLinkRequestBody(
    description: 'Chess Board',
    minimumAmount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    archived: false,
    allowedMethods: [
        Components\PaymentLinkMethod::Ideal,
    ],
    lines: null,
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
    testmode: false,
);

$response = $sdk->paymentLinks->update(
    paymentLinkId: 'pl_d9fQur83kFdhH8hIhaZfq',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentLinkResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                           | Type                                                                                                | Required                                                                                            | Description                                                                                         | Example                                                                                             |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| `paymentLinkId`                                                                                     | *string*                                                                                            | :heavy_check_mark:                                                                                  | Provide the ID of the related payment link.                                                         | pl_d9fQur83kFdhH8hIhaZfq                                                                            |
| `idempotencyKey`                                                                                    | *?string*                                                                                           | :heavy_minus_sign:                                                                                  | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                    | 123e4567-e89b-12d3-a456-426                                                                         |
| `body`                                                                                              | [?Operations\UpdatePaymentLinkRequestBody](../../Models/Operations/UpdatePaymentLinkRequestBody.md) | :heavy_minus_sign:                                                                                  | N/A                                                                                                 |                                                                                                     |

### Response

**[?Operations\UpdatePaymentLinkResponse](../../Models/Operations/UpdatePaymentLinkResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## delete

Payment links which have not been opened and no payments have been made yet can be deleted entirely.
This can be useful for removing payment links that have been incorrectly configured or that are no longer relevant.

Once deleted, the payment link will no longer show up in the API or Mollie dashboard.

To simply disable a payment link without fully deleting it, you can use the `archived` parameter on the
[Update payment link](update-payment-link) endpoint instead.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete-payment-link" method="delete" path="/v2/payment-links/{paymentLinkId}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\DeletePaymentLinkRequestBody(
    testmode: false,
);

$response = $sdk->paymentLinks->delete(
    paymentLinkId: 'pl_d9fQur83kFdhH8hIhaZfq',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                           | Type                                                                                                | Required                                                                                            | Description                                                                                         | Example                                                                                             |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| `paymentLinkId`                                                                                     | *string*                                                                                            | :heavy_check_mark:                                                                                  | Provide the ID of the related payment link.                                                         | pl_d9fQur83kFdhH8hIhaZfq                                                                            |
| `idempotencyKey`                                                                                    | *?string*                                                                                           | :heavy_minus_sign:                                                                                  | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                    | 123e4567-e89b-12d3-a456-426                                                                         |
| `body`                                                                                              | [?Operations\DeletePaymentLinkRequestBody](../../Models/Operations/DeletePaymentLinkRequestBody.md) | :heavy_minus_sign:                                                                                  | N/A                                                                                                 |                                                                                                     |

### Response

**[?Operations\DeletePaymentLinkResponse](../../Models/Operations/DeletePaymentLinkResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listPayments

Retrieve the list of payments for a specific payment link.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-payment-link-payments" method="get" path="/v2/payment-links/{paymentLinkId}/payments" example="get-payment-link-payments-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetPaymentLinkPaymentsRequest(
    paymentLinkId: 'pl_d9fQur83kFdhH8hIhaZfq',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->paymentLinks->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                            | Type                                                                                                 | Required                                                                                             | Description                                                                                          |
| ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| `$request`                                                                                           | [Operations\GetPaymentLinkPaymentsRequest](../../Models/Operations/GetPaymentLinkPaymentsRequest.md) | :heavy_check_mark:                                                                                   | The request object to use for the request.                                                           |

### Response

**[?Operations\GetPaymentLinkPaymentsResponse](../../Models/Operations/GetPaymentLinkPaymentsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |