# DelayedRouting

## Overview

### Available Operations

* [create](#create) - Create a delayed route
* [list](#list) - List payment routes
* [get](#get) - Get a delayed route

## create

Create a route for a specific payment.
The routed amount is credited to the account of your customer.

### Example Usage

<!-- UsageSnippet language="php" operationID="payment-create-route" method="post" path="/v2/payments/{paymentId}/routes" example="create-route-201-1" -->
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

$body = new Components\RouteCreateRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    destination: new Components\RouteCreateRequestDestination(
        type: Components\RouteDestinationType::Organization,
        organizationId: 'org_1234567',
    ),
    description: 'Payment for Order #12345',
);

$response = $sdk->delayedRouting->create(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->routeCreateResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `paymentId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related payment.                                           | tr_5B8cwPMGnU                                                                    |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |
| `body`                                                                           | [?Components\RouteCreateRequest](../../Models/Components/RouteCreateRequest.md)  | :heavy_minus_sign:                                                               | N/A                                                                              |                                                                                  |

### Response

**[?Operations\PaymentCreateRouteResponse](../../Models/Operations/PaymentCreateRouteResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all routes created for a specific payment.

### Example Usage

<!-- UsageSnippet language="php" operationID="payment-list-routes" method="get" path="/v2/payments/{paymentId}/routes" example="list-routes-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->delayedRouting->list(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `paymentId`                                                                                                                                                                                                                                                                                                                                                                              | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related payment.                                                                                                                                                                                                                                                                                                                                                   | tr_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                            |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\PaymentListRoutesResponse](../../Models/Operations/PaymentListRoutesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single route created for a specific payment.

### Example Usage

<!-- UsageSnippet language="php" operationID="payment-get-route" method="get" path="/v2/payments/{paymentId}/routes/{routeId}" example="get-route-200-1" -->
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



$response = $sdk->delayedRouting->get(
    paymentId: 'tr_5B8cwPMGnU',
    routeId: 'crt_dyARQ3JzCgtPDhU2Pbq3J',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->routeGetResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `paymentId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related payment.                                           | tr_5B8cwPMGnU                                                                    |
| `routeId`                                                                        | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the route.                                                     | crt_dyARQ3JzCgtPDhU2Pbq3J                                                        |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\PaymentGetRouteResponse](../../Models/Operations/PaymentGetRouteResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |