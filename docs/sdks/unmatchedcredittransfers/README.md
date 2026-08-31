# UnmatchedCreditTransfers

## Overview

### Available Operations

* [list](#list) - List unmatched credit transfers
* [get](#get) - Get unmatched credit transfer
* [match](#match) - Match unmatched credit transfer
* [return](#return) - Return unmatched credit transfer

## list

> 🚧 Beta feature
>
> This feature is currently in private beta, and the final specification may still change.

Retrieves a list of unmatched credit transfers for the profile.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-unmatched-credit-transfers" method="get" path="/v2/unmatched-credit-transfers" example="list-unmatched-credit-transfers-200-1" -->
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



$responses = $sdk->unmatchedCreditTransfers->list(
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

| Parameter                                                                                                                      | Type                                                                                                                           | Required                                                                                                                       | Description                                                                                                                    | Example                                                                                                                        |
| ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ |
| `from`                                                                                                                         | *?string*                                                                                                                      | :heavy_minus_sign:                                                                                                             | Provide an ID to start the result set from the item with the given ID and onwards. This allows you to paginate the<br/>result set. |                                                                                                                                |
| `limit`                                                                                                                        | *?int*                                                                                                                         | :heavy_minus_sign:                                                                                                             | The maximum number of items to return. Defaults to 50 items.                                                                   | 50                                                                                                                             |
| `idempotencyKey`                                                                                                               | *?string*                                                                                                                      | :heavy_minus_sign:                                                                                                             | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                               | 123e4567-e89b-12d3-a456-426                                                                                                    |

### Response

**[?Operations\ListUnmatchedCreditTransfersResponse](../../Models/Operations/ListUnmatchedCreditTransfersResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

> 🚧 Beta feature
>
> This feature is currently in private beta, and the final specification may still change.

Retrieves a single unmatched credit transfer by its identifier.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-unmatched-credit-transfer" method="get" path="/v2/unmatched-credit-transfers/{unmatchedCreditTransferId}" example="get-unmatched-credit-transfer-200-1" -->
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



$response = $sdk->unmatchedCreditTransfers->get(
    unmatchedCreditTransferId: 'uct_abcDEFghij123456789',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityUnmatchedCreditTransfer !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `unmatchedCreditTransferId`                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related unmatched credit transfer.                         | uct_abcDEFghij123456789                                                          |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetUnmatchedCreditTransferResponse](../../Models/Operations/GetUnmatchedCreditTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## match

> 🚧 Beta feature
>
> This feature is currently in private beta, and the final specification may still change.

Matches an unmatched credit transfer to one or more payments, settling the funds accordingly.

### Example Usage

<!-- UsageSnippet language="php" operationID="match-unmatched-credit-transfer" method="post" path="/v2/unmatched-credit-transfers/{unmatchedCreditTransferId}/match" example="match-unmatched-credit-transfer-201-1" -->
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

$body = new Components\UnmatchedCreditTransferMatchRequest(
    paymentIds: [
        'tr_5B8cwPMGnU',
    ],
);

$response = $sdk->unmatchedCreditTransfers->match(
    unmatchedCreditTransferId: 'uct_abcDEFghij123456789',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->unmatchedCreditTransferActionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       | Example                                                                                                           |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `unmatchedCreditTransferId`                                                                                       | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Provide the ID of the related unmatched credit transfer.                                                          | uct_abcDEFghij123456789                                                                                           |
| `idempotencyKey`                                                                                                  | *?string*                                                                                                         | :heavy_minus_sign:                                                                                                | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                  | 123e4567-e89b-12d3-a456-426                                                                                       |
| `body`                                                                                                            | [?Components\UnmatchedCreditTransferMatchRequest](../../Models/Components/UnmatchedCreditTransferMatchRequest.md) | :heavy_minus_sign:                                                                                                | N/A                                                                                                               |                                                                                                                   |

### Response

**[?Operations\MatchUnmatchedCreditTransferResponse](../../Models/Operations/MatchUnmatchedCreditTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## return

> 🚧 Beta feature
>
> This feature is currently in private beta, and the final specification may still change.

Returns an unmatched credit transfer, sending the funds back to the original sender.

### Example Usage

<!-- UsageSnippet language="php" operationID="return-unmatched-credit-transfer" method="post" path="/v2/unmatched-credit-transfers/{unmatchedCreditTransferId}/return" example="return-unmatched-credit-transfer-201-1" -->
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



$response = $sdk->unmatchedCreditTransfers->return(
    unmatchedCreditTransferId: 'uct_abcDEFghij123456789',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->unmatchedCreditTransferActionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `unmatchedCreditTransferId`                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related unmatched credit transfer.                         | uct_abcDEFghij123456789                                                          |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\ReturnUnmatchedCreditTransferResponse](../../Models/Operations/ReturnUnmatchedCreditTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |