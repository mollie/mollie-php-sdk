# BalanceTransfers

## Overview

### Available Operations

* [create](#create) - Create a Connect balance transfer
* [list](#list) - List all Connect balance transfers
* [get](#get) - Get a Connect balance transfer

## create

This API endpoint allows you to create a balance transfer from your organization's balance to a connected organization's balance, or vice versa.
You can also create a balance transfer between two connected organizations.
To create a balance transfer, you must be authenticated as the source organization, and the destination organization must be a connected organization
that has authorized the `balance-transfers.write` scope for your organization.

### Example Usage: create-balance-transfer-200-1

<!-- UsageSnippet language="php" operationID="create-connect-balance-transfer" method="post" path="/v2/connect/balance-transfers" example="create-balance-transfer-200-1" -->
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

$body = new Components\EntityBalanceTransfer(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    source: new Components\EntityBalanceTransferParty(
        type: Components\BalanceTransferPartyType::Organization,
        id: 'org_1234567',
        description: 'Invoice fee',
    ),
    destination: new Components\EntityBalanceTransferParty(
        type: Components\BalanceTransferPartyType::Organization,
        id: 'org_1234567',
        description: 'Invoice fee',
    ),
    description: 'Invoice fee',
    category: Components\BalanceTransferCategory::InvoiceCollection,
    metadata: [
        'order_id' => 12345,
        'customer_id' => 9876,
    ],
    testmode: false,
);

$response = $sdk->balanceTransfers->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->entityBalanceTransferResponse !== null) {
    // handle response
}
```
### Example Usage: create-balance-transfer-422-1

<!-- UsageSnippet language="php" operationID="create-connect-balance-transfer" method="post" path="/v2/connect/balance-transfers" example="create-balance-transfer-422-1" -->
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

$body = new Components\EntityBalanceTransfer(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    source: new Components\EntityBalanceTransferParty(
        type: Components\BalanceTransferPartyType::Organization,
        id: 'org_1234567',
        description: 'Invoice fee',
    ),
    destination: new Components\EntityBalanceTransferParty(
        type: Components\BalanceTransferPartyType::Organization,
        id: 'org_1234567',
        description: 'Invoice fee',
    ),
    description: 'Invoice fee',
    category: Components\BalanceTransferCategory::InvoiceCollection,
    metadata: [
        'order_id' => 12345,
        'customer_id' => 9876,
    ],
    testmode: false,
);

$response = $sdk->balanceTransfers->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->entityBalanceTransferResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                             | Type                                                                                  | Required                                                                              | Description                                                                           | Example                                                                               |
| ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                      | *?string*                                                                             | :heavy_minus_sign:                                                                    | A unique key to ensure idempotent requests. This key should be a UUID v4 string.      | 123e4567-e89b-12d3-a456-426                                                           |
| `body`                                                                                | [?Components\EntityBalanceTransfer](../../Models/Components/EntityBalanceTransfer.md) | :heavy_minus_sign:                                                                    | N/A                                                                                   |                                                                                       |

### Response

**[?Operations\CreateConnectBalanceTransferResponse](../../Models/Operations/CreateConnectBalanceTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Returns a paginated list of balance transfers associated with your organization. These may be a balance transfer that was received or sent from your balance, or a balance transfer that you initiated on behalf of your clients. If no balance transfers are available, the resulting array will be empty. This request should never throw an error.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-connect-balance-transfers" method="get" path="/v2/connect/balance-transfers" example="list-balance-transfer-200-1" -->
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

$request = new Operations\ListConnectBalanceTransfersRequest(
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->balanceTransfers->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                                      | Type                                                                                                           | Required                                                                                                       | Description                                                                                                    |
| -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                     | [Operations\ListConnectBalanceTransfersRequest](../../Models/Operations/ListConnectBalanceTransfersRequest.md) | :heavy_check_mark:                                                                                             | The request object to use for the request.                                                                     |

### Response

**[?Operations\ListConnectBalanceTransfersResponse](../../Models/Operations/ListConnectBalanceTransfersResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single Connect balance transfer object by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-connect-balance-transfer" method="get" path="/v2/connect/balance-transfers/{balanceTransferId}" example="get-balance-transfer-200-1" -->
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



$response = $sdk->balanceTransfers->get(
    balanceTransferId: 'cbtr_j8NvRAM2WNZtsykpLEX8J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityBalanceTransferResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                               | Type                                                                                                                                                                    | Required                                                                                                                                                                | Description                                                                                                                                                             | Example                                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `balanceTransferId`                                                                                                                                                     | *string*                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                      | Provide the ID of the related balance transfer.                                                                                                                         | cbtr_j8NvRAM2WNZtsykpLEX8J                                                                                                                                              |
| `testmode`                                                                                                                                                              | *?bool*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                      | You can enable test mode by setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                        | *?string*                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                             |

### Response

**[?Operations\GetConnectBalanceTransferResponse](../../Models/Operations/GetConnectBalanceTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |