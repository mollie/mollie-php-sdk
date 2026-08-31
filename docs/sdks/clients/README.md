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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$responses = $sdk->clients->list(
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

| Parameter                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | Type                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   | Required                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            | Example                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `embed`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | This endpoint allows embedding related API items by appending the<br/>following values via the `embed` query string parameter.<br/><br/>* `organization`: Include the organization of the client. Available for `signuplink` partners, or for `oauth`<br/>  partners with the `organizations.read` scope.<br/>* `onboarding`: Include the onboarding status of the client. Available for `signuplink` partners, or for `oauth`<br/>  partners with the `onboarding.read` scope.<br/>* `capabilities`: Include the [capabilities](list-capabilities) of the client organization.<br/>  Available for *oauth* partners with the `onboarding.read` scope. |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| `from`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | Provide an ID to start the result set from the item with the given ID and onwards. This allows you to paginate the<br/>result set.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| `limit`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                | *?int*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | The maximum number of items to return. Defaults to 50 items.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           | 50                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |

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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->clients->get(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->clients->get(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->clients->get(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

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

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->clients->get(
    organizationId: 'org_1234567',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | Type                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   | Required                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            | Example                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `organizationId`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       | *string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | Provide the ID of the related organization.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            | org_1234567                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| `embed`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | This endpoint allows embedding related API items by appending the following values via the `embed` query string<br/>parameter.<br/><br/>* `organization`: Include the organization of the client. Available for `signuplink` partners, or for `oauth`<br/>  partners with the `organizations.read` scope.<br/>* `onboarding`: Include the onboarding status of the client. Available for `signuplink` partners, or for `oauth`<br/>  partners with the `onboarding.read` scope.<br/>* `capabilities`: Include the [capabilities](list-capabilities) of the client organization.<br/>  Available for *oauth* partners with the `onboarding.read` scope. |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |

### Response

**[?Operations\GetClientResponse](../../Models/Operations/GetClientResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |