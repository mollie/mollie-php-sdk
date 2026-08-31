# Invoices

## Overview

### Available Operations

* [list](#list) - List invoices
* [get](#get) - Get invoice

## list

Retrieve a list of all your invoices, optionally filtered by year or by
invoice reference.

The results are paginated.

### Example Usage: list-invoices-200-1

<!-- UsageSnippet language="php" operationID="list-invoices" method="get" path="/v2/invoices" example="list-invoices-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListInvoicesRequest(
    reference: '2024.10000',
    year: '2024',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->invoices->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-invoices-200-2

<!-- UsageSnippet language="php" operationID="list-invoices" method="get" path="/v2/invoices" example="list-invoices-200-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListInvoicesRequest(
    reference: '2024.10000',
    year: '2024',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->invoices->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-invoices-200-3

<!-- UsageSnippet language="php" operationID="list-invoices" method="get" path="/v2/invoices" example="list-invoices-200-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListInvoicesRequest(
    reference: '2024.10000',
    year: '2024',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->invoices->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-invoices-200-4

<!-- UsageSnippet language="php" operationID="list-invoices" method="get" path="/v2/invoices" example="list-invoices-200-4" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListInvoicesRequest(
    reference: '2024.10000',
    year: '2024',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->invoices->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Operations\ListInvoicesRequest](../../Models/Operations/ListInvoicesRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\ListInvoicesResponse](../../Models/Operations/ListInvoicesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single invoice by its ID.

If you want to retrieve the details of an invoice by its invoice number,
call the [List invoices](list-invoices) endpoint with the `reference` parameter.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-invoice" method="get" path="/v2/invoices/{invoiceId}" example="get-invoice-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->invoices->get(
    invoiceId: 'inv_aHbjjdrUdm',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityInvoice !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `invoiceId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related invoice.                                           | inv_aHbjjdrUdm                                                                   |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetInvoiceResponse](../../Models/Operations/GetInvoiceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |