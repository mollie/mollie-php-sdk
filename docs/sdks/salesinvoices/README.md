# SalesInvoices

## Overview

### Available Operations

* [create](#create) - Create sales invoice
* [list](#list) - List sales invoices
* [get](#get) - Get sales invoice
* [update](#update) - Update sales invoice
* [delete](#delete) - Delete sales invoice

## create

With the Sales Invoice API you can generate sales invoices to send to your customers.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-sales-invoice" method="post" path="/v2/sales-invoices" -->
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

$body = new Components\SalesInvoiceRequest(
    testmode: false,
    profileId: 'pfl_QkEhN94Ba',
    status: Components\SalesInvoiceStatus::Draft,
    vatScheme: Components\SalesInvoiceVatScheme::Standard,
    vatMode: Components\SalesInvoiceVatMode::Exclusive,
    memo: 'This is a memo!',
    paymentTerm: Components\SalesInvoicePaymentTerm::Thirtydays,
    paymentDetails: new Components\SalesInvoicePaymentDetails(
        source: Components\SalesInvoicePaymentDetailsSource::PaymentLink,
        sourceReference: 'pl_d9fQur83kFdhH8hIhaZfq',
    ),
    emailDetails: new Components\SalesInvoiceEmailDetails(
        subject: 'Your invoice is available',
        body: 'Please find your invoice enclosed.',
    ),
    customerId: 'cst_8wmqcHMN4U',
    mandateId: 'mdt_pWUnw6pkBN',
    recipientIdentifier: 'customer-xyz-0123',
    recipient: new Components\SalesInvoiceRecipient(
        type: Components\SalesInvoiceRecipientType::Consumer,
        title: 'Mrs.',
        givenName: 'Jane',
        familyName: 'Doe',
        organizationName: 'Organization Corp.',
        organizationNumber: '12345678',
        vatNumber: 'NL123456789B01',
        email: 'example@email.com',
        phone: '+0123456789',
        streetAndNumber: 'Keizersgracht 126',
        streetAdditional: '4th floor',
        postalCode: '5678AB',
        city: 'Amsterdam',
        region: 'Noord-Holland',
        country: 'NL',
        locale: Components\SalesInvoiceRecipientLocale::NLNL,
    ),
    lines: [
        new Components\SalesInvoiceLineItem(
            description: 'LEGO 4440 Forest Police Station',
            quantity: 1,
            vatRate: '21.00',
            unitPrice: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            discount: new Components\SalesInvoiceDiscount(
                type: Components\SalesInvoiceDiscountType::Amount,
                value: '10.00',
            ),
        ),
    ],
    discount: new Components\SalesInvoiceDiscount(
        type: Components\SalesInvoiceDiscountType::Amount,
        value: '10.00',
    ),
    isEInvoice: false,
);

$response = $sdk->salesInvoices->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                               | Type                                                                                                                                                                                    | Required                                                                                                                                                                                | Description                                                                                                                                                                             | Example                                                                                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                                                                                                        | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                                             |
| `xClientSignature`                                                                                                                                                                      | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A cryptographic signature of the request, used to verify that it was sent by you and hasn't been tampered with. Required if you've enabled request signing for your integration.        | MEUCIQDx8sJvK3z...                                                                                                                                                                      |
| `xClientSignedAt`                                                                                                                                                                       | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | The timestamp, in ISO 8601 format, at which you generated the `X-Client-Signature`. Required together with `X-Client-Signature` if you've enabled request signing for your integration. | 2025-01-01T12:00:00Z                                                                                                                                                                    |
| `body`                                                                                                                                                                                  | [?Components\SalesInvoiceRequest](../../Models/Components/SalesInvoiceRequest.md)                                                                                                       | :heavy_minus_sign:                                                                                                                                                                      | N/A                                                                                                                                                                                     |                                                                                                                                                                                         |

### Response

**[?Operations\CreateSalesInvoiceResponse](../../Models/Operations/CreateSalesInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all sales invoices created through the API.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-sales-invoices" method="get" path="/v2/sales-invoices" -->
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

$request = new Operations\ListSalesInvoicesRequest(
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->salesInvoices->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\ListSalesInvoicesRequest](../../Models/Operations/ListSalesInvoicesRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\ListSalesInvoicesResponse](../../Models/Operations/ListSalesInvoicesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single sales invoice by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-sales-invoice" method="get" path="/v2/sales-invoices/{salesInvoiceId}" -->
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

$request = new Operations\GetSalesInvoiceRequest(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->salesInvoices->get(
    request: $request
);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Operations\GetSalesInvoiceRequest](../../Models/Operations/GetSalesInvoiceRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\GetSalesInvoiceResponse](../../Models/Operations/GetSalesInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Certain details of an existing sales invoice can be updated. For `draft` it is all values listed below, but for
statuses `paid` and `issued` there are certain additional requirements (`paymentDetails` and `emailDetails`,
respectively).

### Example Usage

<!-- UsageSnippet language="php" operationID="update-sales-invoice" method="patch" path="/v2/sales-invoices/{salesInvoiceId}" -->
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

$request = new Operations\UpdateSalesInvoiceRequest(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: new Operations\UpdateSalesInvoiceRequestBody(
        testmode: false,
        status: Components\SalesInvoiceStatusUpdate::Draft,
        memo: 'An updated memo!',
        paymentTerm: Components\SalesInvoicePaymentTerm::Thirtydays,
        paymentDetails: new Components\SalesInvoicePaymentDetails(
            source: Components\SalesInvoicePaymentDetailsSource::PaymentLink,
            sourceReference: 'pl_d9fQur83kFdhH8hIhaZfq',
        ),
        emailDetails: new Components\SalesInvoiceEmailDetails(
            subject: 'Your invoice is available',
            body: 'Please find your invoice enclosed.',
        ),
        recipientIdentifier: 'customer-xyz-0123',
        recipient: new Components\SalesInvoiceRecipient(
            type: Components\SalesInvoiceRecipientType::Consumer,
            title: 'Mrs.',
            givenName: 'Jane',
            familyName: 'Doe',
            organizationName: 'Organization Corp.',
            organizationNumber: '12345678',
            vatNumber: 'NL123456789B01',
            email: 'example@email.com',
            phone: '+0123456789',
            streetAndNumber: 'Keizersgracht 126',
            streetAdditional: '4th floor',
            postalCode: '5678AB',
            city: 'Amsterdam',
            region: 'Noord-Holland',
            country: 'NL',
            locale: Components\SalesInvoiceRecipientLocale::NLNL,
        ),
        lines: [
            new Components\SalesInvoiceLineItem(
                description: 'LEGO 4440 Forest Police Station',
                quantity: 1,
                vatRate: '21.00',
                unitPrice: new Components\Amount(
                    currency: 'EUR',
                    value: '10.00',
                ),
                discount: new Components\SalesInvoiceDiscount(
                    type: Components\SalesInvoiceDiscountType::Amount,
                    value: '10.00',
                ),
            ),
        ],
        discount: new Components\SalesInvoiceDiscount(
            type: Components\SalesInvoiceDiscountType::Amount,
            value: '10.00',
        ),
        isEInvoice: false,
    ),
);

$response = $sdk->salesInvoices->update(
    request: $request
);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `$request`                                                                                   | [Operations\UpdateSalesInvoiceRequest](../../Models/Operations/UpdateSalesInvoiceRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\UpdateSalesInvoiceResponse](../../Models/Operations/UpdateSalesInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## delete

Sales invoices which are in status `draft` can be deleted. For all other statuses, please use the
[Update sales invoice](update-sales-invoice) endpoint instead.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete-sales-invoice" method="delete" path="/v2/sales-invoices/{salesInvoiceId}" -->
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

$request = new Operations\DeleteSalesInvoiceRequest(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: new Components\DeleteValuesSalesInvoice(
        testmode: false,
    ),
);

$response = $sdk->salesInvoices->delete(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `$request`                                                                                   | [Operations\DeleteSalesInvoiceRequest](../../Models/Operations/DeleteSalesInvoiceRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\DeleteSalesInvoiceResponse](../../Models/Operations/DeleteSalesInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |