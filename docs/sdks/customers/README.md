# Customers

## Overview

### Available Operations

* [create](#create) - Create customer
* [list](#list) - List customers
* [get](#get) - Get customer
* [update](#update) - Update customer
* [delete](#delete) - Delete customer
* [createPayment](#createpayment) - Create customer payment
* [listPayments](#listpayments) - List customer payments

## create

Creates a simple minimal representation of a customer. Payments, recurring mandates, and subscriptions can be linked
to this customer object, which simplifies management of recurring payments.

Once registered, customers will also appear in your Mollie dashboard.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-customer" method="post" path="/v2/customers" example="create-customer-201-1" -->
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

$body = new Components\EntityCustomer(
    name: 'John Doe',
    email: 'example@email.com',
    locale: Components\LocaleResponse::EnUS,
    testmode: false,
);

$response = $sdk->customers->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->customerResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |
| `body`                                                                           | [?Components\EntityCustomer](../../Models/Components/EntityCustomer.md)          | :heavy_minus_sign:                                                               | N/A                                                                              |                                                                                  |

### Response

**[?Operations\CreateCustomerResponse](../../Models/Operations/CreateCustomerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all customers.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-customers" method="get" path="/v2/customers" example="list-customers" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListCustomersRequest(
    from: 'cst_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->customers->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\ListCustomersRequest](../../Models/Operations/ListCustomersRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\ListCustomersResponse](../../Models/Operations/ListCustomersResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single customer by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-customer" method="get" path="/v2/customers/{customerId}" example="get-customer-200-1" -->
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



$response = $sdk->customers->get(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->customerResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `customerId`                                                                                                                                                                                                                                                                                                                                                                             | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related customer.                                                                                                                                                                                                                                                                                                                                                  | cst_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                           |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetCustomerResponse](../../Models/Operations/GetCustomerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Update an existing customer.

For an in-depth explanation of each parameter, refer to the [Create customer](create-customer) endpoint.

### Example Usage: update-customer-200-1

<!-- UsageSnippet language="php" operationID="update-customer" method="patch" path="/v2/customers/{customerId}" example="update-customer-200-1" -->
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

$body = new Operations\UpdateCustomerRequestBody(
    name: 'John Doe',
    email: 'example@email.com',
    locale: Components\LocaleResponse::EnUS,
    testmode: false,
);

$response = $sdk->customers->update(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->customerResponse !== null) {
    // handle response
}
```
### Example Usage: update-customer-200-2

<!-- UsageSnippet language="php" operationID="update-customer" method="patch" path="/v2/customers/{customerId}" example="update-customer-200-2" -->
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

$body = new Operations\UpdateCustomerRequestBody(
    name: 'John Doe',
    email: 'example@email.com',
    locale: Components\LocaleResponse::EnUS,
    testmode: false,
);

$response = $sdk->customers->update(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->customerResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                     | Type                                                                                          | Required                                                                                      | Description                                                                                   | Example                                                                                       |
| --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| `customerId`                                                                                  | *string*                                                                                      | :heavy_check_mark:                                                                            | Provide the ID of the related customer.                                                       | cst_5B8cwPMGnU                                                                                |
| `idempotencyKey`                                                                              | *?string*                                                                                     | :heavy_minus_sign:                                                                            | A unique key to ensure idempotent requests. This key should be a UUID v4 string.              | 123e4567-e89b-12d3-a456-426                                                                   |
| `body`                                                                                        | [?Operations\UpdateCustomerRequestBody](../../Models/Operations/UpdateCustomerRequestBody.md) | :heavy_minus_sign:                                                                            | N/A                                                                                           |                                                                                               |

### Response

**[?Operations\UpdateCustomerResponse](../../Models/Operations/UpdateCustomerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## delete

Delete a customer. All mandates and subscriptions created for this customer will be canceled as well.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete-customer" method="delete" path="/v2/customers/{customerId}" -->
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

$body = new Operations\DeleteCustomerRequestBody(
    testmode: false,
);

$response = $sdk->customers->delete(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                     | Type                                                                                          | Required                                                                                      | Description                                                                                   | Example                                                                                       |
| --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| `customerId`                                                                                  | *string*                                                                                      | :heavy_check_mark:                                                                            | Provide the ID of the related customer.                                                       | cst_5B8cwPMGnU                                                                                |
| `idempotencyKey`                                                                              | *?string*                                                                                     | :heavy_minus_sign:                                                                            | A unique key to ensure idempotent requests. This key should be a UUID v4 string.              | 123e4567-e89b-12d3-a456-426                                                                   |
| `body`                                                                                        | [?Operations\DeleteCustomerRequestBody](../../Models/Operations/DeleteCustomerRequestBody.md) | :heavy_minus_sign:                                                                            | N/A                                                                                           |                                                                                               |

### Response

**[?Operations\DeleteCustomerResponse](../../Models/Operations/DeleteCustomerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## createPayment

Creates a payment for the customer.

Linking customers to payments enables you to:

* Keep track of payment preferences for your customers
* Allow your customers to charge a previously used credit card with a single click in our hosted checkout
* Improve payment insights in the Mollie dashboard
* Use recurring payments

This endpoint is effectively an alias of the [Create payment endpoint](create-payment) with the `customerId`
parameter predefined.

### Example Usage: create-payment-201-1

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-10

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-10" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-11

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-11" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-12

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-12" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-13

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-13" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-2

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-3

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-4

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-4" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-5

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-5" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-6

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-6" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-7

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-7" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-8

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-8" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```
### Example Usage: create-payment-201-9

<!-- UsageSnippet language="php" operationID="create-customer-payment" method="post" path="/v2/customers/{customerId}/payments" example="create-payment-201-9" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\PaymentRequest(
    description: 'Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    redirectUrl: 'https://example.org/redirect',
    cancelUrl: 'https://example.org/cancel',
    webhookUrl: 'https://example.org/webhooks',
    lines: [
        new Components\PaymentRequestLine(
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
            recurring: new Components\RecurringLineItem(
                description: 'Gym subscription',
                interval: '12 months',
                amount: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                times: 1,
                startDate: '2024-12-12',
            ),
        ),
    ],
    billingAddress: new Components\PaymentRequestBillingAddress(
        title: 'Mr.',
        givenName: 'Piet',
        familyName: 'Mondriaan',
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
    locale: Components\Locale::EnUS,
    method: Components\MethodEnum::Ideal,
    issuer: 'ideal_INGBNL2A',
    restrictPaymentMethodsToCountry: 'NL',
    captureMode: Components\CaptureMode::Manual,
    captureDelay: '8 hours',
    applicationFee: new Components\PaymentRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: '10',
    ),
    routing: [
        new Components\EntityPaymentRoute(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            destination: new Components\EntityPaymentRouteDestination(
                type: Components\RouteDestinationType::Organization,
                organizationId: 'org_1234567',
            ),
            releaseDate: '2024-12-12',
        ),
    ],
    sequenceType: Components\SequenceType::Oneoff,
    mandateId: 'mdt_5B8cwPMGnU',
    customerId: 'cst_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    dueDate: '2025-12-08',
    storeCredentials: true,
    testmode: false,
    applePayPaymentToken: '{"paymentData": {"version": "EC_v1", "data": "vK3BbrCbI/...."}}',
    company: new Components\Company(
        registrationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        entityType: 'LLC',
    ),
    cardToken: 'tkn_12345',
    googlePayPaymentToken: '{"signature": "MEYCIQCv...", "protocolVersion": "ECv2", "signedMessage": "{\\"encryptedMessage\\":\\"...\\",\\"ephemeralPublicKey\\":\\"...\\",\\"tag\\":\\"...\\"}"}',
    voucherNumber: '1234567890',
    voucherPin: '1234',
    consumerDateOfBirth: LocalDate::parse('2000-01-01'),
    digitalGoods: true,
    customerReference: '1234567890',
    terminalId: 'term_1234567890',
);

$response = $sdk->customers->createPayment(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->paymentResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `customerId`                                                                     | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related customer.                                          | cst_5B8cwPMGnU                                                                   |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |
| `body`                                                                           | [?Components\PaymentRequest](../../Models/Components/PaymentRequest.md)          | :heavy_minus_sign:                                                               | N/A                                                                              |                                                                                  |

### Response

**[?Operations\CreateCustomerPaymentResponse](../../Models/Operations/CreateCustomerPaymentResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\ErrorResponse | 503                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listPayments

Retrieve all payments linked to the customer.

### Example Usage: list-payments-200-1

<!-- UsageSnippet language="php" operationID="list-customer-payments" method="get" path="/v2/customers/{customerId}/payments" example="list-payments-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListCustomerPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->customers->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-payments-200-2

<!-- UsageSnippet language="php" operationID="list-customer-payments" method="get" path="/v2/customers/{customerId}/payments" example="list-payments-200-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListCustomerPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->customers->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-payments-200-3

<!-- UsageSnippet language="php" operationID="list-customer-payments" method="get" path="/v2/customers/{customerId}/payments" example="list-payments-200-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListCustomerPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->customers->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                        | Type                                                                                             | Required                                                                                         | Description                                                                                      |
| ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ |
| `$request`                                                                                       | [Operations\ListCustomerPaymentsRequest](../../Models/Operations/ListCustomerPaymentsRequest.md) | :heavy_check_mark:                                                                               | The request object to use for the request.                                                       |

### Response

**[?Operations\ListCustomerPaymentsResponse](../../Models/Operations/ListCustomerPaymentsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |