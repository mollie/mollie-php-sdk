# Captures

## Overview

### Available Operations

* [create](#create) - Create capture
* [list](#list) - List captures
* [get](#get) - Get capture

## create

Capture an *authorized* payment.

Some payment methods allow you to first collect a customer's authorization,
and capture the amount at a later point.

By default, Mollie captures payments automatically. If however you
configured your payment with `captureMode: manual`, you can capture the payment using this endpoint after
having collected the customer's authorization.

### Example Usage: get-capture-200-1

<!-- UsageSnippet language="php" operationID="create-capture" method="post" path="/v2/payments/{paymentId}/captures" example="get-capture-200-1" -->
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

$body = new Components\EntityCapture(
    description: 'Capture for cart #12345',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    testmode: false,
);

$response = $sdk->captures->create(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->captureResponse !== null) {
    // handle response
}
```
### Example Usage: get-capture-200-2

<!-- UsageSnippet language="php" operationID="create-capture" method="post" path="/v2/payments/{paymentId}/captures" example="get-capture-200-2" -->
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

$body = new Components\EntityCapture(
    description: 'Capture for cart #12345',
    amount: new Components\AmountNullable(
        currency: 'EUR',
        value: '10.00',
    ),
    testmode: false,
);

$response = $sdk->captures->create(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->captureResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `paymentId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related payment.                                           | tr_5B8cwPMGnU                                                                    |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |
| `body`                                                                           | [?Components\EntityCapture](../../Models/Components/EntityCapture.md)            | :heavy_minus_sign:                                                               | N/A                                                                              |                                                                                  |

### Response

**[?Operations\CreateCaptureResponse](../../Models/Operations/CreateCaptureResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all captures created for a specific payment.

The results are paginated.

### Example Usage: list-captures-200-1

<!-- UsageSnippet language="php" operationID="list-captures" method="get" path="/v2/payments/{paymentId}/captures" example="list-captures-200-1" -->
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

$request = new Operations\ListCapturesRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 'cpt_vytxeTZskVKR7C7WgdSP3d',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->captures->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-captures-200-2

<!-- UsageSnippet language="php" operationID="list-captures" method="get" path="/v2/payments/{paymentId}/captures" example="list-captures-200-2" -->
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

$request = new Operations\ListCapturesRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 'cpt_vytxeTZskVKR7C7WgdSP3d',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->captures->list(
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
| `$request`                                                                       | [Operations\ListCapturesRequest](../../Models/Operations/ListCapturesRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\ListCapturesResponse](../../Models/Operations/ListCapturesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payment capture by its ID and the ID of its parent
payment.

### Example Usage: get-capture-200-1

<!-- UsageSnippet language="php" operationID="get-capture" method="get" path="/v2/payments/{paymentId}/captures/{captureId}" example="get-capture-200-1" -->
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

$request = new Operations\GetCaptureRequest(
    paymentId: 'tr_5B8cwPMGnU',
    captureId: 'cpt_vytxeTZskVKR7C7WgdSP3d',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->captures->get(
    request: $request
);

if ($response->captureResponse !== null) {
    // handle response
}
```
### Example Usage: get-capture-200-2

<!-- UsageSnippet language="php" operationID="get-capture" method="get" path="/v2/payments/{paymentId}/captures/{captureId}" example="get-capture-200-2" -->
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

$request = new Operations\GetCaptureRequest(
    paymentId: 'tr_5B8cwPMGnU',
    captureId: 'cpt_vytxeTZskVKR7C7WgdSP3d',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->captures->get(
    request: $request
);

if ($response->captureResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                    | Type                                                                         | Required                                                                     | Description                                                                  |
| ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- |
| `$request`                                                                   | [Operations\GetCaptureRequest](../../Models/Operations/GetCaptureRequest.md) | :heavy_check_mark:                                                           | The request object to use for the request.                                   |

### Response

**[?Operations\GetCaptureResponse](../../Models/Operations/GetCaptureResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |