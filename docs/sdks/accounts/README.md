# Accounts

## Overview

### Available Operations

* [listAccounts](#listaccounts) - List business accounts
* [getAccount](#getaccount) - Get business account
* [list](#list) - List transactions
* [get](#get) - Get transaction

## listAccounts

> 🔒 Restricted access
>
> This API is only available to Mollie partners with a signed agreement for Business Accounts. [Get in touch](https://www.mollie.com/contact) if you'd like to integrate with it.

Retrieve all business accounts for the authenticated organization.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-business-accounts" method="get" path="/v2/business-accounts/accounts" example="list-business-accounts-200" -->
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
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBusinessAccountsRequest(
    from: 'ba_nopqrstuvwxyz23456789A',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->accounts->listAccounts(
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
| `$request`                                                                                       | [Operations\ListBusinessAccountsRequest](../../Models/Operations/ListBusinessAccountsRequest.md) | :heavy_check_mark:                                                                               | The request object to use for the request.                                                       |

### Response

**[?Operations\ListBusinessAccountsResponse](../../Models/Operations/ListBusinessAccountsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getAccount

> 🔒 Restricted access
>
> This API is only available to Mollie partners with a signed agreement for Business Accounts. [Get in touch](https://www.mollie.com/contact) if you'd like to integrate with it.

Retrieve a single business account object by its account ID. This allows you to check the current status,
balance, and account details.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-business-account" method="get" path="/v2/business-accounts/accounts/{businessAccountId}" example="get-business-account-200" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();



$response = $sdk->accounts->getAccount(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->businessAccountResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `businessAccountId`                                                                                                                                                                                                                                                                                                                                                                      | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related business account.                                                                                                                                                                                                                                                                                                                                          | ba_nopqrstuvwxyz23456789A                                                                                                                                                                                                                                                                                                                                                                |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetBusinessAccountResponse](../../Models/Operations/GetBusinessAccountResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

> 🔒 Restricted access
>
> This API is only available to Mollie partners with a signed agreement for Business Accounts. [Get in touch](https://www.mollie.com/contact) if you'd like to integrate with it.

Retrieve all transactions for a specific business account.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-business-account-transactions" method="get" path="/v2/business-accounts/accounts/{businessAccountId}/transactions" example="list-transactions-200" -->
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
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBusinessAccountTransactionsRequest(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    from: 'batr_87GByBuj4UCcUTEbs6aGJ',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->accounts->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                                              | Type                                                                                                                   | Required                                                                                                               | Description                                                                                                            |
| ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                             | [Operations\ListBusinessAccountTransactionsRequest](../../Models/Operations/ListBusinessAccountTransactionsRequest.md) | :heavy_check_mark:                                                                                                     | The request object to use for the request.                                                                             |

### Response

**[?Operations\ListBusinessAccountTransactionsResponse](../../Models/Operations/ListBusinessAccountTransactionsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

> 🔒 Restricted access
>
> This API is only available to Mollie partners with a signed agreement for Business Accounts. [Get in touch](https://www.mollie.com/contact) if you'd like to integrate with it.

Retrieve a single transaction object by its transaction ID. This allows you to check the details,
amount, counterparty, and balance impact of a specific transaction.

### Example Usage: get-transaction-200

<!-- UsageSnippet language="php" operationID="get-business-account-transaction" method="get" path="/v2/business-accounts/accounts/{businessAccountId}/transactions/{transactionId}" example="get-transaction-200" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();



$response = $sdk->accounts->get(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    transactionId: 'batr_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->transactionResponse !== null) {
    // handle response
}
```
### Example Usage: get-transaction-200-credit

<!-- UsageSnippet language="php" operationID="get-business-account-transaction" method="get" path="/v2/business-accounts/accounts/{businessAccountId}/transactions/{transactionId}" example="get-transaction-200-credit" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();



$response = $sdk->accounts->get(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    transactionId: 'batr_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->transactionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `businessAccountId`                                                                                                                                                                                                                                                                                                                                                                      | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related business account.                                                                                                                                                                                                                                                                                                                                          | ba_nopqrstuvwxyz23456789A                                                                                                                                                                                                                                                                                                                                                                |
| `transactionId`                                                                                                                                                                                                                                                                                                                                                                          | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related transaction.                                                                                                                                                                                                                                                                                                                                               | batr_87GByBuj4UCcUTEbs6aGJ                                                                                                                                                                                                                                                                                                                                                               |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetBusinessAccountTransactionResponse](../../Models/Operations/GetBusinessAccountTransactionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |