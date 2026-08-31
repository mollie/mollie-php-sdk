# Balances

## Overview

### Available Operations

* [list](#list) - List balances
* [get](#get) - Get balance
* [getPrimary](#getprimary) - Get primary balance
* [getReport](#getreport) - Get balance report
* [listTransactions](#listtransactions) - List balance transactions

## list

Retrieve a list of the organization's balances, including the primary balance.

The results are paginated.

### Example Usage: list-balances-200-1

<!-- UsageSnippet language="php" operationID="list-balances" method="get" path="/v2/balances" example="list-balances-200-1" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBalancesRequest(
    currency: 'EUR',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->balances->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-balances-200-2

<!-- UsageSnippet language="php" operationID="list-balances" method="get" path="/v2/balances" example="list-balances-200-2" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBalancesRequest(
    currency: 'EUR',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->balances->list(
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
| `$request`                                                                       | [Operations\ListBalancesRequest](../../Models/Operations/ListBalancesRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\ListBalancesResponse](../../Models/Operations/ListBalancesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

When processing payments with Mollie, we put all pending funds — usually
minus Mollie fees — on a balance. Once you have linked a bank account to your Mollie account, we can pay out your
balance towards this bank account.

With the Balances API you can retrieve your current balance. The response
includes two amounts:

* The *pending amount*. These are payments that have been marked as `paid`,
but are not yet available on your balance.
* The *available amount*. This is the amount that you can get paid out to
your bank account, or use for refunds.

With instant payment methods like iDEAL, payments are moved to the available
balance instantly. With slower payment methods, like credit card for example, it can take a few days before the
funds are available on your balance. These funds will be shown under the *pending amount* in the meanwhile.

### Example Usage: get-balance-200-1

<!-- UsageSnippet language="php" operationID="get-balance" method="get" path="/v2/balances/{balanceId}" example="get-balance-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->balances->get(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityBalance !== null) {
    // handle response
}
```
### Example Usage: get-balance-200-2

<!-- UsageSnippet language="php" operationID="get-balance" method="get" path="/v2/balances/{balanceId}" example="get-balance-200-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->balances->get(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityBalance !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                               | Type                                                                                                                                                                    | Required                                                                                                                                                                | Description                                                                                                                                                             | Example                                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `balanceId`                                                                                                                                                             | *string*                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                      | Provide the ID of the related balance.                                                                                                                                  | bal_gVMhHKqSSRYJyPsuoPNFH                                                                                                                                               |
| `testmode`                                                                                                                                                              | *?bool*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                      | You can enable test mode by setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                        | *?string*                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                             |

### Response

**[?Operations\GetBalanceResponse](../../Models/Operations/GetBalanceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getPrimary

Retrieve the primary balance. This is the balance of your account's primary
currency, where all payments are settled to by default.

This endpoint is a convenient alias of the [Get balance](get-balance)
endpoint.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-primary-balance" method="get" path="/v2/balances/primary" example="get-primary-balance-200-1" -->
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



$response = $sdk->balances->getPrimary(
    idempotencyKey: '123e4567-e89b-12d3-a456-426'
);

if ($response->entityBalance !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetPrimaryBalanceResponse](../../Models/Operations/GetPrimaryBalanceResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getReport

Retrieve a summarized report for all transactions on a given balance within a given timeframe.

The API also provides a detailed report on all 'prepayments' for Mollie fees that were deducted from your balance
during the reported period, ahead of your Mollie invoice.

The alias `primary` can be used instead of the balance ID to refer to the
organization's primary balance.

### Example Usage: get-balance-report-200-1

<!-- UsageSnippet language="php" operationID="get-balance-report" method="get" path="/v2/balances/{balanceId}/report" example="get-balance-report-200-1" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetBalanceReportRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    from: '2024-01-01',
    until: '2024-02-01',
    grouping: Components\BalanceReportGrouping::StatusBalances,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->balances->getReport(
    request: $request
);

if ($response->entityBalanceReport !== null) {
    // handle response
}
```
### Example Usage: get-balance-report-200-2

<!-- UsageSnippet language="php" operationID="get-balance-report" method="get" path="/v2/balances/{balanceId}/report" example="get-balance-report-200-2" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetBalanceReportRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    from: '2024-01-01',
    until: '2024-02-01',
    grouping: Components\BalanceReportGrouping::StatusBalances,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->balances->getReport(
    request: $request
);

if ($response->entityBalanceReport !== null) {
    // handle response
}
```
### Example Usage: get-balance-report-200-3

<!-- UsageSnippet language="php" operationID="get-balance-report" method="get" path="/v2/balances/{balanceId}/report" example="get-balance-report-200-3" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetBalanceReportRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    from: '2024-01-01',
    until: '2024-02-01',
    grouping: Components\BalanceReportGrouping::StatusBalances,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->balances->getReport(
    request: $request
);

if ($response->entityBalanceReport !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                | Type                                                                                     | Required                                                                                 | Description                                                                              |
| ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------- |
| `$request`                                                                               | [Operations\GetBalanceReportRequest](../../Models/Operations/GetBalanceReportRequest.md) | :heavy_check_mark:                                                                       | The request object to use for the request.                                               |

### Response

**[?Operations\GetBalanceReportResponse](../../Models/Operations/GetBalanceReportResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listTransactions

Retrieve a list of all balance transactions. Transactions include for
example payments, refunds, chargebacks, and settlements.

For an aggregated report of these balance transactions, refer to the [Get
balance report](get-balance-report) endpoint.

The alias `primary` can be used instead of the balance ID to refer to the
organization's primary balance.

The results are paginated.

### Example Usage: list-balance-transactions-200-1

<!-- UsageSnippet language="php" operationID="list-balance-transactions" method="get" path="/v2/balances/{balanceId}/transactions" example="list-balance-transactions-200-1" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBalanceTransactionsRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->balances->listTransactions(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-balance-transactions-200-2

<!-- UsageSnippet language="php" operationID="list-balance-transactions" method="get" path="/v2/balances/{balanceId}/transactions" example="list-balance-transactions-200-2" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBalanceTransactionsRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->balances->listTransactions(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                              | Type                                                                                                   | Required                                                                                               | Description                                                                                            |
| ------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                             | [Operations\ListBalanceTransactionsRequest](../../Models/Operations/ListBalanceTransactionsRequest.md) | :heavy_check_mark:                                                                                     | The request object to use for the request.                                                             |

### Response

**[?Operations\ListBalanceTransactionsResponse](../../Models/Operations/ListBalanceTransactionsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |