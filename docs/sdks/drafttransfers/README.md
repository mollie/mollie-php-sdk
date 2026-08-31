# DraftTransfers

## Overview

### Available Operations

* [create](#create) - Create draft transfer
* [list](#list) - List draft transfers
* [get](#get) - Get draft transfer
* [cancel](#cancel) - Cancel draft transfer

## create

> 🚧 Beta feature
>
> This feature is currently in beta testing, and the final specification may still change.

Creates a draft transfer. The draft transfer immediately enters `pending-review` and appears in the
initiator's queue in Mollie Apps. It carries no legal weight and moves no funds until a human initiator
approves it there.

### Test mode

Creating a draft transfer always returns a synthetic draft in `pending-review`, using synthetic data,
same as in live mode. No real funds move and nothing is sent to Mollie Apps.

Shortly after, you can simulate the initiator's decision by adjusting the transfer amount:

| Amount  | Simulated outcome                                    | Webhook sequence                                                                                  |
|---------|-------------------------------------------------------|----------------------------------------------------------------------------------------------------|
| `13.00` | Declined by the initiator, with a free-text reason     | `business-account-draft-transfer.created` → `business-account-draft-transfer.declined`             |
| Other   | Approved by the initiator                              | `business-account-draft-transfer.created` → `business-account-draft-transfer.approved`              |

The webhooks fire asynchronously, with a short delay between them to mimic real timing. [Get](get-draft-transfer)
and [list](list-draft-transfers) reflect the simulated outcome once it lands.

Cancelling (via `DELETE`) is unaffected by the amount: it always transitions the draft to `declined` with
`statusReason.code` set to `deleted-by-creator`, the same as in live mode.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-draft-transfer" method="post" path="/v2/business-accounts/draft-transfers" example="create-draft-transfer-201" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Brick\DateTime\LocalDate;
use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Components\CreateDraftTransferRequest(
    debtorIban: 'NL55MLLE0123456789',
    creditor: new Components\DraftTransferParty(
        fullName: 'Jan Jansen',
        account: new Components\DraftTransferPartyAccount(
            iban: 'NL02ABNA0123456789',
        ),
    ),
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Invoice 12345',
    scheduledExecutionDate: LocalDate::parse('2025-03-01'),
    testmode: false,
);

$response = $sdk->draftTransfers->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->draftTransferResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                       | Type                                                                                            | Required                                                                                        | Description                                                                                     | Example                                                                                         |
| ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                | *?string*                                                                                       | :heavy_minus_sign:                                                                              | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                | 123e4567-e89b-12d3-a456-426                                                                     |
| `body`                                                                                          | [?Components\CreateDraftTransferRequest](../../Models/Components/CreateDraftTransferRequest.md) | :heavy_minus_sign:                                                                              | N/A                                                                                             |                                                                                                 |

### Response

**[?Operations\CreateDraftTransferResponse](../../Models/Operations/CreateDraftTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

> 🚧 Beta feature
>
> This feature is currently in beta testing, and the final specification may still change.

Retrieves a list of draft transfers created via this API for the organization.

The results are paginated.

In test mode, this returns synthetic draft transfers only, not your real data. See [Create draft
transfer](create-draft-transfer) for how to simulate `approved` and `declined` outcomes.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-draft-transfers" method="get" path="/v2/business-accounts/draft-transfers" example="list-draft-transfers-200" -->
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

$request = new Operations\ListDraftTransfersRequest(
    limit: 50,
    status: Components\DraftTransferStatus::PendingReview,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->draftTransfers->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `$request`                                                                                   | [Operations\ListDraftTransfersRequest](../../Models/Operations/ListDraftTransfersRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\ListDraftTransfersResponse](../../Models/Operations/ListDraftTransfersResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

> 🚧 Beta feature
>
> This feature is currently in beta testing, and the final specification may still change.

Retrieves a single draft transfer by its identifier.

Only draft transfers created via this API are visible via this endpoint. Draft transfers created in Mollie
Apps return a `404`, even though they appear in the [list endpoint](list-draft-transfers).

In test mode, this returns synthetic data only, not your real draft transfer. See [Create draft
transfer](create-draft-transfer) for how to simulate `approved` and `declined` outcomes.

### Example Usage: approved-draft-transfer

<!-- UsageSnippet language="php" operationID="get-draft-transfer" method="get" path="/v2/business-accounts/draft-transfers/{draftTransferId}" example="approved-draft-transfer" -->
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



$response = $sdk->draftTransfers->get(
    draftTransferId: 'badrt_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->draftTransferResponse !== null) {
    // handle response
}
```
### Example Usage: declined-by-initiator-draft-transfer

<!-- UsageSnippet language="php" operationID="get-draft-transfer" method="get" path="/v2/business-accounts/draft-transfers/{draftTransferId}" example="declined-by-initiator-draft-transfer" -->
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



$response = $sdk->draftTransfers->get(
    draftTransferId: 'badrt_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->draftTransferResponse !== null) {
    // handle response
}
```
### Example Usage: get-draft-transfer-200

<!-- UsageSnippet language="php" operationID="get-draft-transfer" method="get" path="/v2/business-accounts/draft-transfers/{draftTransferId}" example="get-draft-transfer-200" -->
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



$response = $sdk->draftTransfers->get(
    draftTransferId: 'badrt_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->draftTransferResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `draftTransferId`                                                                                                                                                                                                                                                                                                                                                                        | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related draft transfer.                                                                                                                                                                                                                                                                                                                                            | badrt_87GByBuj4UCcUTEbs6aGJ                                                                                                                                                                                                                                                                                                                                                              |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetDraftTransferResponse](../../Models/Operations/GetDraftTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## cancel

> 🚧 Beta feature
>
> This feature is currently in beta testing, and the final specification may still change.

Cancels a draft transfer created via this API. Transitions the draft transfer to `declined` with
`statusReason.code` set to `deleted-by-creator`.

Only draft transfers created via this API, and still in `pending-review`, can be cancelled this way. A
`422` is returned if the initiator has already started approving it.

In test mode, this always returns a synthetic `declined` draft. See [Create draft
transfer](create-draft-transfer) for how to simulate `approved` and `declined` outcomes.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancel-draft-transfer" method="delete" path="/v2/business-accounts/draft-transfers/{draftTransferId}" example="cancel-draft-transfer-200" -->
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

$body = new Operations\CancelDraftTransferRequestBody(
    testmode: false,
);

$response = $sdk->draftTransfers->cancel(
    draftTransferId: 'badrt_87GByBuj4UCcUTEbs6aGJ',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->draftTransferResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                               | Type                                                                                                    | Required                                                                                                | Description                                                                                             | Example                                                                                                 |
| ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- |
| `draftTransferId`                                                                                       | *string*                                                                                                | :heavy_check_mark:                                                                                      | Provide the ID of the related draft transfer.                                                           | badrt_87GByBuj4UCcUTEbs6aGJ                                                                             |
| `idempotencyKey`                                                                                        | *?string*                                                                                               | :heavy_minus_sign:                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                        | 123e4567-e89b-12d3-a456-426                                                                             |
| `body`                                                                                                  | [?Operations\CancelDraftTransferRequestBody](../../Models/Operations/CancelDraftTransferRequestBody.md) | :heavy_minus_sign:                                                                                      | N/A                                                                                                     |                                                                                                         |

### Response

**[?Operations\CancelDraftTransferResponse](../../Models/Operations/CancelDraftTransferResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |