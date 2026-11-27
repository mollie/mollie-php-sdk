# Clients

## Overview

### Available Operations

* [list](#list) - List clients
* [get](#get) - Get client

## list

Retrieve a list of all clients linked to your account.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-clients" method="get" path="/v2/clients" example="list-clients-200-1" -->
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

$request = new Operations\ListClientsRequest(
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->clients->list(
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
| `$request`                                                                     | [Operations\ListClientsRequest](../../Models/Operations/ListClientsRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\ListClientsResponse](../../Models/Operations/ListClientsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single client by its ID.

### Example Usage: get-client-200-1

<!-- UsageSnippet language="php" operationID="get-client" method="get" path="/v2/clients/{organizationId}" example="get-client-200-1" -->
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

$request = new Operations\GetClientRequest(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->clients->get(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: get-client-200-2

<!-- UsageSnippet language="php" operationID="get-client" method="get" path="/v2/clients/{organizationId}" example="get-client-200-2" -->
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

$request = new Operations\GetClientRequest(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->clients->get(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: get-client-200-3

<!-- UsageSnippet language="php" operationID="get-client" method="get" path="/v2/clients/{organizationId}" example="get-client-200-3" -->
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

$request = new Operations\GetClientRequest(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->clients->get(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: get-client-200-4

<!-- UsageSnippet language="php" operationID="get-client" method="get" path="/v2/clients/{organizationId}" example="get-client-200-4" -->
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

$request = new Operations\GetClientRequest(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->clients->get(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                  | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `$request`                                                                 | [Operations\GetClientRequest](../../Models/Operations/GetClientRequest.md) | :heavy_check_mark:                                                         | The request object to use for the request.                                 |

### Response

**[?Operations\GetClientResponse](../../Models/Operations/GetClientResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |