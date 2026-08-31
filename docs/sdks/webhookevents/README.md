# WebhookEvents

## Overview

### Available Operations

* [get](#get) - Get a Webhook Event

## get

Retrieve a single webhook event object by its event ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-webhook-event" method="get" path="/v2/events/{webhookEventId}" example="get-webhook-event-200" -->
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



$response = $sdk->webhookEvents->get(
    webhookEventId: 'event_1234567890',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityWebhookEvent !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                               | Type                                                                                                                                                                    | Required                                                                                                                                                                | Description                                                                                                                                                             | Example                                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `webhookEventId`                                                                                                                                                        | *string*                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                      | Provide the ID of the related webhook event.                                                                                                                            | event_1234567890                                                                                                                                                        |
| `testmode`                                                                                                                                                              | *?bool*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                      | You can enable test mode by setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                        | *?string*                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                             |

### Response

**[?Operations\GetWebhookEventResponse](../../Models/Operations/GetWebhookEventResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |