# Accounts

## Overview

### Available Operations

* [createAccount](#createaccount) - Create business account
* [listAccounts](#listaccounts) - List business accounts
* [getAccount](#getaccount) - Get business account
* [list](#list) - List transactions
* [get](#get) - Get transaction

## createAccount

> 🚧 Beta feature
>
> This feature is currently in beta testing, and the final specification may still change.

> 🔐 **Request signing required**
>
> Signature enforcement is mandatory for Direct Customer API users for `live` mode requests.
>
> Sign every request with the `X-Client-Signature` and `X-Client-Signed-At` headers.
>
> [Learn how to sign requests](https://docs.mollie.com/reference/request-signing)

Create a new business account for the authenticated organization.

The response contains the newly created business account.

Each organization can have up to 5 active business accounts. Need more? [Contact us](https://www.mollie.com/contact)
and we'll help you out.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-business-account" method="post" path="/v2/business-accounts/accounts" example="create-business-account-201" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();

$body = new Operations\CreateBusinessAccountRequestBody(
    name: 'Main Checking Account',
    currency: Components\AccountCurrency::Eur,
    testmode: false,
);

$response = $sdk->accounts->createAccount(
    idempotencyKey: '00000000-0000-0000-0000-000000000000',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: $body

);

if ($response->businessAccountResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                                                           | Type                                                                                                                                                                                                                                                                                                                                                                                                                                | Required                                                                                                                                                                                                                                                                                                                                                                                                                            | Description                                                                                                                                                                                                                                                                                                                                                                                                                         | Example                                                                                                                                                                                                                                                                                                                                                                                                                             |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                                                                    | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                           | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                  | A unique value that identifies this request, so you can safely retry it without creating a second account.<br/>Retrying with the same key within one hour returns the original response. We recommend a UUIDv4.<br/><br/>Keys are tied to the credential that sent the original request, so a refreshed OAuth token won't match<br/>earlier keys. View the [public documentation](https://docs.mollie.com/reference/api-idempotency) to learn<br/>more. | 00000000-0000-0000-0000-000000000000                                                                                                                                                                                                                                                                                                                                                                                                |
| `xClientSignature`                                                                                                                                                                                                                                                                                                                                                                                                                  | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                           | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                  | A cryptographic signature of the request, used to verify that it was sent by you and hasn't been tampered with. Required if you've enabled request signing for your integration.                                                                                                                                                                                                                                                    | MEUCIQDx8sJvK3z...                                                                                                                                                                                                                                                                                                                                                                                                                  |
| `xClientSignedAt`                                                                                                                                                                                                                                                                                                                                                                                                                   | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                           | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                  | The timestamp, in ISO 8601 format, at which you generated the `X-Client-Signature`. Required together with `X-Client-Signature` if you've enabled request signing for your integration.                                                                                                                                                                                                                                             | 2025-01-01T12:00:00Z                                                                                                                                                                                                                                                                                                                                                                                                                |
| `body`                                                                                                                                                                                                                                                                                                                                                                                                                              | [?Operations\CreateBusinessAccountRequestBody](../../Models/Operations/CreateBusinessAccountRequestBody.md)                                                                                                                                                                                                                                                                                                                         | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                  | N/A                                                                                                                                                                                                                                                                                                                                                                                                                                 |                                                                                                                                                                                                                                                                                                                                                                                                                                     |

### Response

**[?Operations\CreateBusinessAccountResponse](../../Models/Operations/CreateBusinessAccountResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 409, 422, 429   | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listAccounts

> 🔐 **Request signing required**
>
> Signature enforcement is mandatory for Direct Customer API users for `live` mode requests.
>
> Sign every request with the `X-Client-Signature` and `X-Client-Signed-At` headers.
>
> [Learn how to sign requests](https://docs.mollie.com/reference/request-signing)

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
    iban: 'NL95MLLE1234567890',
    from: 'ba_nopqrstuvwxyz23456789A',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
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

> 🔐 **Request signing required**
>
> Signature enforcement is mandatory for Direct Customer API users for `live` mode requests.
>
> Sign every request with the `X-Client-Signature` and `X-Client-Signed-At` headers.
>
> [Learn how to sign requests](https://docs.mollie.com/reference/request-signing)

Retrieve a single business account object by its account ID. This allows you to check the current status,
balance, and account details.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-business-account" method="get" path="/v2/business-accounts/accounts/{businessAccountId}" example="get-business-account-200" -->
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

$request = new Operations\GetBusinessAccountRequest(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->accounts->getAccount(
    request: $request
);

if ($response->businessAccountResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `$request`                                                                                   | [Operations\GetBusinessAccountRequest](../../Models/Operations/GetBusinessAccountRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\GetBusinessAccountResponse](../../Models/Operations/GetBusinessAccountResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

> 🔐 **Request signing required**
>
> Signature enforcement is mandatory for Direct Customer API users for `live` mode requests.
>
> Sign every request with the `X-Client-Signature` and `X-Client-Signed-At` headers.
>
> [Learn how to sign requests](https://docs.mollie.com/reference/request-signing)

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
use Mollie\Api\Utils;

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
    creditDebitIndicator: Components\CreditDebitIndicator::Debit,
    processedAfter: Utils\Utils::parseDateTime('2025-02-01T00:00:00+00:00'),
    processedBefore: Utils\Utils::parseDateTime('2025-02-26T23:59:59+00:00'),
    from: 'batr_87GByBuj4UCcUTEbs6aGJ',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
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

> 🔐 **Request signing required**
>
> Signature enforcement is mandatory for Direct Customer API users for `live` mode requests.
>
> Sign every request with the `X-Client-Signature` and `X-Client-Signed-At` headers.
>
> [Learn how to sign requests](https://docs.mollie.com/reference/request-signing)

Retrieve a single transaction object by its transaction ID. This allows you to check the details,
amount, counterparty, and balance impact of a specific transaction.

### Example Usage: get-transaction-200

<!-- UsageSnippet language="php" operationID="get-business-account-transaction" method="get" path="/v2/business-accounts/accounts/{businessAccountId}/transactions/{transactionId}" example="get-transaction-200" -->
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

$request = new Operations\GetBusinessAccountTransactionRequest(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    transactionId: 'batr_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->accounts->get(
    request: $request
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
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            oAuth: '<YOUR_O_AUTH_HERE>',
        )
    )
    ->build();

$request = new Operations\GetBusinessAccountTransactionRequest(
    businessAccountId: 'ba_nopqrstuvwxyz23456789A',
    transactionId: 'batr_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->accounts->get(
    request: $request
);

if ($response->transactionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                          | Type                                                                                                               | Required                                                                                                           | Description                                                                                                        |
| ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------ |
| `$request`                                                                                                         | [Operations\GetBusinessAccountTransactionRequest](../../Models/Operations/GetBusinessAccountTransactionRequest.md) | :heavy_check_mark:                                                                                                 | The request object to use for the request.                                                                         |

### Response

**[?Operations\GetBusinessAccountTransactionResponse](../../Models/Operations/GetBusinessAccountTransactionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |