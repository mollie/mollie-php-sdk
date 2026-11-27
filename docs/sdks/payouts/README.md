# Payouts

## Overview

### Available Operations

* [create](#create) - Create payout
* [list](#list) - List payouts
* [get](#get) - Get payout
* [cancel](#cancel) - Cancel payout

## create

Request a payout from one of your balances to the balance's configured bank account.

The payout will be executed on the next scheduled business day. If no `amount` is specified, the full available
balance minus any configured balance reserve is paid out.

Once the payout is created with status `requested`, you can cancel it via the
[Cancel payout](cancel-payout) endpoint, up until the payout moves to `initiated`.

Creating a payout via the API automatically sets the balance's `transferFrequency` to `never`,
pausing any previously configured automatic settlement schedule. To resume automatic settlements,
update the transfer frequency via the dashboard.

### Webhooks

Subscribe to the following webhook events to track payout status changes. See the
[Webhook Subscriptions API](list-webhooks) for details on subscribing.

| Event | Description |
|---|---|
| `payout.initiated` | The payout is being executed and funds are reserved. |
| `payout.processing-at-bank` | The payout has been submitted to the bank. |
| `payout.completed` | The payout has been sent to the destination bank account. |
| `payout.canceled` | The payout was canceled via the API before being submitted to the bank. |
| `payout.failed` | The payout failed after creation, including bank rejections and post-submission cancellations. |

### Payout failure reasons

A payout request may fail immediately if one of the following conditions applies:

- A payout is already scheduled for the next business day for this balance.
- The balance has insufficient funds.
- The balance is not active.
- Payouts are blocked for this organization.
- The balance has queued refunds.
- One of the organization's balances is below the negative balance threshold.
- The payout destination (bank account) is invalid or not configured.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-payout" method="post" path="/v2/payouts" example="create-payout-201" -->
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

$body = new Components\PayoutRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'My payout description',
    testmode: false,
);

$response = $sdk->payouts->create(
    body: $body,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z'

);

if ($response->entityPayoutResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                               | Type                                                                                                                                                                                    | Required                                                                                                                                                                                | Description                                                                                                                                                                             | Example                                                                                                                                                                                 |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `body`                                                                                                                                                                                  | [Components\PayoutRequest](../../Models/Components/PayoutRequest.md)                                                                                                                    | :heavy_check_mark:                                                                                                                                                                      | N/A                                                                                                                                                                                     |                                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                                        | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                                             |
| `xClientSignature`                                                                                                                                                                      | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | A cryptographic signature of the request, used to verify that it was sent by you and hasn't been tampered with. Required if you've enabled request signing for your integration.        | MEUCIQDx8sJvK3z...                                                                                                                                                                      |
| `xClientSignedAt`                                                                                                                                                                       | *?string*                                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                                      | The timestamp, in ISO 8601 format, at which you generated the `X-Client-Signature`. Required together with `X-Client-Signature` if you've enabled request signing for your integration. | 2025-01-01T12:00:00Z                                                                                                                                                                    |

### Response

**[?Operations\CreatePayoutResponse](../../Models/Operations/CreatePayoutResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all payouts for your organization, including payouts initiated automatically by the
balance's payout schedule and payouts requested via the API or dashboard.

Only payouts created on or after April 1st, 2026 are returned.

The results are paginated. Use the `from` query parameter together with `_links.next` to iterate through
the full result set.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-payouts" method="get" path="/v2/payouts" example="list-payouts-200" -->
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
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListPayoutsRequest(
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->payouts->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                      | Type                                                                           | Required                                                                       | Description                                                                    |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `$request`                                                                     | [Operations\ListPayoutsRequest](../../Models/Operations/ListPayoutsRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\ListPayoutsResponse](../../Models/Operations/ListPayoutsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payout by its ID.

### Example Usage: get-payout-200-completed

<!-- UsageSnippet language="php" operationID="get-payout" method="get" path="/v2/payouts/{payoutId}" example="get-payout-200-completed" -->
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
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetPayoutRequest(
    payoutId: 'payout_j8NvRAM2WNZtsykpLEX8J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->payouts->get(
    request: $request
);

if ($response->entityPayoutResponse !== null) {
    // handle response
}
```
### Example Usage: get-payout-200-failed

<!-- UsageSnippet language="php" operationID="get-payout" method="get" path="/v2/payouts/{payoutId}" example="get-payout-200-failed" -->
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

$request = new Operations\GetPayoutRequest(
    payoutId: 'payout_j8NvRAM2WNZtsykpLEX8J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->payouts->get(
    request: $request
);

if ($response->entityPayoutResponse !== null) {
    // handle response
}
```
### Example Usage: get-payout-200-requested

<!-- UsageSnippet language="php" operationID="get-payout" method="get" path="/v2/payouts/{payoutId}" example="get-payout-200-requested" -->
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
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetPayoutRequest(
    payoutId: 'payout_j8NvRAM2WNZtsykpLEX8J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->payouts->get(
    request: $request
);

if ($response->entityPayoutResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                  | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `$request`                                                                 | [Operations\GetPayoutRequest](../../Models/Operations/GetPayoutRequest.md) | :heavy_check_mark:                                                         | The request object to use for the request.                                 |

### Response

**[?Operations\GetPayoutResponse](../../Models/Operations/GetPayoutResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## cancel

Cancel a payout. A payout can only be canceled while it has the status `requested`. Once the payout moves
to `initiated`, it is too late to cancel.

The canceled payout object is returned with the status set to `canceled`.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancel-payout" method="delete" path="/v2/payouts/{payoutId}" example="cancel-payout-200" -->
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
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\CancelPayoutRequest(
    payoutId: 'payout_j8NvRAM2WNZtsykpLEX8J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->payouts->cancel(
    request: $request
);

if ($response->entityPayoutResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Operations\CancelPayoutRequest](../../Models/Operations/CancelPayoutRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\CancelPayoutResponse](../../Models/Operations/CancelPayoutResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 409, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |