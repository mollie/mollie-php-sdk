# Chargebacks

## Overview

### Available Operations

* [list](#list) - List payment chargebacks
* [get](#get) - Get payment chargeback
* [all](#all) - List all chargebacks

## list

Retrieve the chargebacks initiated for a specific payment.

The results are paginated.

### Example Usage: list-chargeback-200-1

<!-- UsageSnippet language="php" operationID="list-chargebacks" method="get" path="/v2/payments/{paymentId}/chargebacks" example="list-chargeback-200-1" -->
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

$request = new Operations\ListChargebacksRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-chargeback-200-2

<!-- UsageSnippet language="php" operationID="list-chargebacks" method="get" path="/v2/payments/{paymentId}/chargebacks" example="list-chargeback-200-2" -->
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

$request = new Operations\ListChargebacksRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-chargeback-200-3

<!-- UsageSnippet language="php" operationID="list-chargebacks" method="get" path="/v2/payments/{paymentId}/chargebacks" example="list-chargeback-200-3" -->
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

$request = new Operations\ListChargebacksRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Operations\ListChargebacksRequest](../../Models/Operations/ListChargebacksRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\ListChargebacksResponse](../../Models/Operations/ListChargebacksResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payment chargeback by its ID and the ID of its parent payment.

### Example Usage: get-chargeback-200-1

<!-- UsageSnippet language="php" operationID="get-chargeback" method="get" path="/v2/payments/{paymentId}/chargebacks/{chargebackId}" example="get-chargeback-200-1" -->
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

$request = new Operations\GetChargebackRequest(
    paymentId: 'tr_5B8cwPMGnU',
    chargebackId: 'chb_xFzwUN4ci8HAmSGUACS4J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->chargebacks->get(
    request: $request
);

if ($response->entityChargeback !== null) {
    // handle response
}
```
### Example Usage: get-chargeback-200-2

<!-- UsageSnippet language="php" operationID="get-chargeback" method="get" path="/v2/payments/{paymentId}/chargebacks/{chargebackId}" example="get-chargeback-200-2" -->
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

$request = new Operations\GetChargebackRequest(
    paymentId: 'tr_5B8cwPMGnU',
    chargebackId: 'chb_xFzwUN4ci8HAmSGUACS4J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->chargebacks->get(
    request: $request
);

if ($response->entityChargeback !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\GetChargebackRequest](../../Models/Operations/GetChargebackRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\GetChargebackResponse](../../Models/Operations/GetChargebackResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## all

Retrieve all chargebacks initiated for all your payments.

The results are paginated.

### Example Usage: list-all-chargebacks-200-1

<!-- UsageSnippet language="php" operationID="list-all-chargebacks" method="get" path="/v2/chargebacks" example="list-all-chargebacks-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListAllChargebacksRequest(
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->all(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-all-chargebacks-200-2

<!-- UsageSnippet language="php" operationID="list-all-chargebacks" method="get" path="/v2/chargebacks" example="list-all-chargebacks-200-2" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListAllChargebacksRequest(
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->all(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-all-chargebacks-200-3

<!-- UsageSnippet language="php" operationID="list-all-chargebacks" method="get" path="/v2/chargebacks" example="list-all-chargebacks-200-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListAllChargebacksRequest(
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->chargebacks->all(
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
| `$request`                                                                                   | [Operations\ListAllChargebacksRequest](../../Models/Operations/ListAllChargebacksRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\ListAllChargebacksResponse](../../Models/Operations/ListAllChargebacksResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |