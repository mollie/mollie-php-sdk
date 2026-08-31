# Refunds

## Overview

### Available Operations

* [create](#create) - Create payment refund
* [list](#list) - List payment refunds
* [get](#get) - Get payment refund
* [cancel](#cancel) - Cancel payment refund
* [all](#all) - List all refunds

## create

Creates a refund for a specific payment. The refunded amount is credited to your customer usually either via a bank
transfer or by refunding the amount to your customer's credit card.

### Example Usage: create-refund-201-1

<!-- UsageSnippet language="php" operationID="create-refund" method="post" path="/v2/payments/{paymentId}/refunds" example="create-refund-201-1" -->
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

$body = new Components\RefundRequest(
    description: 'Refunding a Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    externalReference: new Components\RefundRequestExternalReference(
        type: Components\RefundExternalReferenceType::AcquirerReference,
        id: '123456789012345',
    ),
    reverseRouting: false,
    routingReversals: [
        new Components\RefundRequestRoutingReversal(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            source: new Components\RefundRequestSource(
                type: Components\RefundRequestType::Organization,
                organizationId: 'org_1234567',
            ),
        ),
    ],
    testmode: false,
);

$response = $sdk->refunds->create(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->refundResponse !== null) {
    // handle response
}
```
### Example Usage: create-refund-201-2

<!-- UsageSnippet language="php" operationID="create-refund" method="post" path="/v2/payments/{paymentId}/refunds" example="create-refund-201-2" -->
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

$body = new Components\RefundRequest(
    description: 'Refunding a Chess Board',
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    externalReference: new Components\RefundRequestExternalReference(
        type: Components\RefundExternalReferenceType::AcquirerReference,
        id: '123456789012345',
    ),
    reverseRouting: false,
    routingReversals: [
        new Components\RefundRequestRoutingReversal(
            amount: new Components\Amount(
                currency: 'EUR',
                value: '10.00',
            ),
            source: new Components\RefundRequestSource(
                type: Components\RefundRequestType::Organization,
                organizationId: 'org_1234567',
            ),
        ),
    ],
    testmode: false,
);

$response = $sdk->refunds->create(
    paymentId: 'tr_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->refundResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `paymentId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related payment.                                           | tr_5B8cwPMGnU                                                                    |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |
| `body`                                                                           | [?Components\RefundRequest](../../Models/Components/RefundRequest.md)            | :heavy_minus_sign:                                                               | N/A                                                                              |                                                                                  |

### Response

**[?Operations\CreateRefundResponse](../../Models/Operations/CreateRefundResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 409, 422, 429   | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all refunds created for a specific payment.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-refunds" method="get" path="/v2/payments/{paymentId}/refunds" example="list-refunds-200-1" -->
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

$request = new Operations\ListRefundsRequest(
    paymentId: 'tr_5B8cwPMGnU',
    from: 're_5B8cwPMGnU',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->refunds->list(
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
| `$request`                                                                     | [Operations\ListRefundsRequest](../../Models/Operations/ListRefundsRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\ListRefundsResponse](../../Models/Operations/ListRefundsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payment refund by its ID and the ID of its parent payment.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-refund" method="get" path="/v2/payments/{paymentId}/refunds/{refundId}" example="get-refund-200-1" -->
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

$request = new Operations\GetRefundRequest(
    paymentId: 'tr_5B8cwPMGnU',
    refundId: 're_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->refunds->get(
    request: $request
);

if ($response->refundResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                  | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `$request`                                                                 | [Operations\GetRefundRequest](../../Models/Operations/GetRefundRequest.md) | :heavy_check_mark:                                                         | The request object to use for the request.                                 |

### Response

**[?Operations\GetRefundResponse](../../Models/Operations/GetRefundResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## cancel

Refunds will be executed with a delay of two hours. Until that time, refunds may be canceled manually via the
Mollie Dashboard, or by using this endpoint.

A refund can only be canceled while its `status` field is either `queued` or `pending`. See the
[Get refund endpoint](get-refund) for more information.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancel-refund" method="delete" path="/v2/payments/{paymentId}/refunds/{refundId}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();



$response = $sdk->refunds->cancel(
    paymentId: 'tr_5B8cwPMGnU',
    refundId: 're_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `paymentId`                                                                                                                                                                                                                                                                                                                                                                              | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related payment.                                                                                                                                                                                                                                                                                                                                                   | tr_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                            |
| `refundId`                                                                                                                                                                                                                                                                                                                                                                               | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related refund.                                                                                                                                                                                                                                                                                                                                                    | re_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                            |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\CancelRefundResponse](../../Models/Operations/CancelRefundResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## all

Retrieve a list of all of your refunds.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-all-refunds" method="get" path="/v2/refunds" example="list-refunds-200-1" -->
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

$request = new Operations\ListAllRefundsRequest(
    from: 're_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->refunds->all(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                            | Type                                                                                 | Required                                                                             | Description                                                                          |
| ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ |
| `$request`                                                                           | [Operations\ListAllRefundsRequest](../../Models/Operations/ListAllRefundsRequest.md) | :heavy_check_mark:                                                                   | The request object to use for the request.                                           |

### Response

**[?Operations\ListAllRefundsResponse](../../Models/Operations/ListAllRefundsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |