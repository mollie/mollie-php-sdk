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
    body: $body

);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                         | Type                                                                              | Required                                                                          | Description                                                                       | Example                                                                           |
| --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                  | *?string*                                                                         | :heavy_minus_sign:                                                                | A unique key to ensure idempotent requests. This key should be a UUID v4 string.  | 123e4567-e89b-12d3-a456-426                                                       |
| `body`                                                                            | [?Components\SalesInvoiceRequest](../../Models/Components/SalesInvoiceRequest.md) | :heavy_minus_sign:                                                                | N/A                                                                               |                                                                                   |

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

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$responses = $sdk->salesInvoices->list(
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
| `from`                                                                                                                                                                                                                                                                                                                                                                                   | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Provide an ID to start the result set from the item with the given ID and onwards. This allows you to paginate the<br/>result set.                                                                                                                                                                                                                                                       |                                                                                                                                                                                                                                                                                                                                                                                          |
| `limit`                                                                                                                                                                                                                                                                                                                                                                                  | *?int*                                                                                                                                                                                                                                                                                                                                                                                   | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | The maximum number of items to return. Defaults to 50 items.                                                                                                                                                                                                                                                                                                                             | 50                                                                                                                                                                                                                                                                                                                                                                                       |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

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

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->salesInvoices->get(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `salesInvoiceId`                                                                                                                                                                                                                                                                                                                                                                         | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related sales invoice.                                                                                                                                                                                                                                                                                                                                             | invoice_4Y0eZitmBnQ6IDoMqZQKh                                                                                                                                                                                                                                                                                                                                                            |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

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

$body = new Operations\UpdateSalesInvoiceRequestBody(
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
);

$response = $sdk->salesInvoices->update(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->salesInvoiceResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                             | Type                                                                                                  | Required                                                                                              | Description                                                                                           | Example                                                                                               |
| ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- |
| `salesInvoiceId`                                                                                      | *string*                                                                                              | :heavy_check_mark:                                                                                    | Provide the ID of the related sales invoice.                                                          | invoice_4Y0eZitmBnQ6IDoMqZQKh                                                                         |
| `idempotencyKey`                                                                                      | *?string*                                                                                             | :heavy_minus_sign:                                                                                    | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                      | 123e4567-e89b-12d3-a456-426                                                                           |
| `body`                                                                                                | [?Operations\UpdateSalesInvoiceRequestBody](../../Models/Operations/UpdateSalesInvoiceRequestBody.md) | :heavy_minus_sign:                                                                                    | N/A                                                                                                   |                                                                                                       |

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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\DeleteValuesSalesInvoice(
    testmode: false,
);

$response = $sdk->salesInvoices->delete(
    salesInvoiceId: 'invoice_4Y0eZitmBnQ6IDoMqZQKh',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                   | Type                                                                                        | Required                                                                                    | Description                                                                                 | Example                                                                                     |
| ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- |
| `salesInvoiceId`                                                                            | *string*                                                                                    | :heavy_check_mark:                                                                          | Provide the ID of the related sales invoice.                                                | invoice_4Y0eZitmBnQ6IDoMqZQKh                                                               |
| `idempotencyKey`                                                                            | *?string*                                                                                   | :heavy_minus_sign:                                                                          | A unique key to ensure idempotent requests. This key should be a UUID v4 string.            | 123e4567-e89b-12d3-a456-426                                                                 |
| `body`                                                                                      | [?Components\DeleteValuesSalesInvoice](../../Models/Components/DeleteValuesSalesInvoice.md) | :heavy_minus_sign:                                                                          | N/A                                                                                         |                                                                                             |

### Response

**[?Operations\DeleteSalesInvoiceResponse](../../Models/Operations/DeleteSalesInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |