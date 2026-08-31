# Webhooks

## Overview

### Available Operations

* [create](#create) - Create a webhook
* [list](#list) - List all webhooks
* [update](#update) - Update a webhook
* [get](#get) - Get a webhook
* [delete](#delete) - Delete a webhook
* [test](#test) - Test a webhook

## create

A webhook must have a name, an url and a list of event types. You can also create webhooks in the webhooks settings section of the Dashboard.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-webhook" method="post" path="/v2/webhooks" example="create-webhook-200" -->
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

$body = new Operations\CreateWebhookRequestBody(
    name: 'Webhook #1',
    url: 'https://mollie.com/',
    eventTypes: Components\WebhookEventTypes::PaymentLinkPaid,
    testmode: false,
);

$response = $sdk->webhooks->create(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->createWebhook !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                   | Type                                                                                        | Required                                                                                    | Description                                                                                 | Example                                                                                     |
| ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                            | *?string*                                                                                   | :heavy_minus_sign:                                                                          | A unique key to ensure idempotent requests. This key should be a UUID v4 string.            | 123e4567-e89b-12d3-a456-426                                                                 |
| `body`                                                                                      | [?Operations\CreateWebhookRequestBody](../../Models/Operations/CreateWebhookRequestBody.md) | :heavy_minus_sign:                                                                          | N/A                                                                                         |                                                                                             |

### Response

**[?Operations\CreateWebhookResponse](../../Models/Operations/CreateWebhookResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 422, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Returns a paginated list of your webhooks. If no webhook endpoints are available, the resulting array will be empty. This request should never throw an error.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-webhooks" method="get" path="/v2/webhooks" example="list-webhook-200" -->
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

$request = new Operations\ListWebhooksRequest(
    limit: 50,
    sort: Components\Sorting::Desc,
    eventTypes: Components\WebhookEventTypes::PaymentLinkPaid,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->webhooks->list(
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
| `$request`                                                                       | [Operations\ListWebhooksRequest](../../Models/Operations/ListWebhooksRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\ListWebhooksResponse](../../Models/Operations/ListWebhooksResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Updates the webhook. You may edit the name, url and the list of subscribed event types.

### Example Usage

<!-- UsageSnippet language="php" operationID="update-webhook" method="patch" path="/v2/webhooks/{webhookId}" example="create-webhook-200" -->
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

$body = new Operations\UpdateWebhookRequestBody(
    name: 'Webhook #1',
    url: 'https://mollie.com/',
    eventTypes: Components\WebhookEventTypes::PaymentLinkPaid,
    testmode: false,
);

$response = $sdk->webhooks->update(
    webhookId: 'hook_1234567890',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->entityWebhook !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                   | Type                                                                                        | Required                                                                                    | Description                                                                                 | Example                                                                                     |
| ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------- |
| `webhookId`                                                                                 | *string*                                                                                    | :heavy_check_mark:                                                                          | Provide the ID of the related webhook.                                                      | hook_1234567890                                                                             |
| `idempotencyKey`                                                                            | *?string*                                                                                   | :heavy_minus_sign:                                                                          | A unique key to ensure idempotent requests. This key should be a UUID v4 string.            | 123e4567-e89b-12d3-a456-426                                                                 |
| `body`                                                                                      | [?Operations\UpdateWebhookRequestBody](../../Models/Operations/UpdateWebhookRequestBody.md) | :heavy_minus_sign:                                                                          | N/A                                                                                         |                                                                                             |

### Response

**[?Operations\UpdateWebhookResponse](../../Models/Operations/UpdateWebhookResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single webhook object by its ID.

### Example Usage: get-webhook-200

<!-- UsageSnippet language="php" operationID="get-webhook" method="get" path="/v2/webhooks/{webhookId}" example="get-webhook-200" -->
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



$response = $sdk->webhooks->get(
    webhookId: 'hook_1234567890',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityWebhook !== null) {
    // handle response
}
```
### Example Usage: get-webhook-200-1

<!-- UsageSnippet language="php" operationID="get-webhook" method="get" path="/v2/webhooks/{webhookId}" example="get-webhook-200-1" -->
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



$response = $sdk->webhooks->get(
    webhookId: 'hook_1234567890',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityWebhook !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                               | Type                                                                                                                                                                    | Required                                                                                                                                                                | Description                                                                                                                                                             | Example                                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `webhookId`                                                                                                                                                             | *string*                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                      | Provide the ID of the related webhook.                                                                                                                                  | hook_1234567890                                                                                                                                                         |
| `testmode`                                                                                                                                                              | *?bool*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                      | You can enable test mode by setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                        | *?string*                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                             |

### Response

**[?Operations\GetWebhookResponse](../../Models/Operations/GetWebhookResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## delete

Delete a single webhook object by its webhook ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete-webhook" method="delete" path="/v2/webhooks/{webhookId}" -->
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

$body = new Operations\DeleteWebhookRequestBody(
    testmode: false,
);

$response = $sdk->webhooks->delete(
    webhookId: 'hook_1234567890',
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
| `webhookId`                                                                                 | *string*                                                                                    | :heavy_check_mark:                                                                          | Provide the ID of the related webhook.                                                      | hook_1234567890                                                                             |
| `idempotencyKey`                                                                            | *?string*                                                                                   | :heavy_minus_sign:                                                                          | A unique key to ensure idempotent requests. This key should be a UUID v4 string.            | 123e4567-e89b-12d3-a456-426                                                                 |
| `body`                                                                                      | [?Operations\DeleteWebhookRequestBody](../../Models/Operations/DeleteWebhookRequestBody.md) | :heavy_minus_sign:                                                                          | N/A                                                                                         |                                                                                             |

### Response

**[?Operations\DeleteWebhookResponse](../../Models/Operations/DeleteWebhookResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## test

Sends a test event to the webhook to verify the endpoint is working as expected.

### Example Usage

<!-- UsageSnippet language="php" operationID="test-webhook" method="post" path="/v2/webhooks/{webhookId}/ping" -->
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

$body = new Operations\TestWebhookRequestBody(
    testmode: false,
);

$response = $sdk->webhooks->test(
    webhookId: 'hook_1234567890',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                               | Type                                                                                    | Required                                                                                | Description                                                                             | Example                                                                                 |
| --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- |
| `webhookId`                                                                             | *string*                                                                                | :heavy_check_mark:                                                                      | Provide the ID of the related webhook.                                                  | hook_1234567890                                                                         |
| `idempotencyKey`                                                                        | *?string*                                                                               | :heavy_minus_sign:                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.        | 123e4567-e89b-12d3-a456-426                                                             |
| `body`                                                                                  | [?Operations\TestWebhookRequestBody](../../Models/Operations/TestWebhookRequestBody.md) | :heavy_minus_sign:                                                                      | N/A                                                                                     |                                                                                         |

### Response

**[?Operations\TestWebhookResponse](../../Models/Operations/TestWebhookResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |