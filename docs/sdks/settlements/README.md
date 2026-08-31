# Settlements

## Overview

### Available Operations

* [list](#list) - List settlements
* [get](#get) - Get settlement
* [getOpen](#getopen) - Get open settlement
* [getNext](#getnext) - Get next settlement
* [listPayments](#listpayments) - List settlement payments
* [listCaptures](#listcaptures) - List settlement captures
* [listRefunds](#listrefunds) - List settlement refunds
* [listChargebacks](#listchargebacks) - List settlement chargebacks

## list

Retrieve a list of all your settlements.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-settlements" method="get" path="/v2/settlements" example="list-settlements-200-1" -->
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

$request = new Operations\ListSettlementsRequest(
    limit: 50,
    balanceId: 'bal_gVMhHKqSSRYJyPsuoPNFH',
    year: '2025',
    month: '1',
    currencies: Components\Currencies::Eur,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->list(
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
| `$request`                                                                             | [Operations\ListSettlementsRequest](../../Models/Operations/ListSettlementsRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\ListSettlementsResponse](../../Models/Operations/ListSettlementsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single settlement by its ID.

To lookup settlements by their bank reference, replace the ID in the URL by
a reference. For example: `1234567.2404.03`.

A settlement represents a transfer of your balance funds to your external bank account.

Settlements will typically include a report that details what balance transactions have taken place between this
settlement and the previous one.

For more accurate bookkeeping, refer to the [balance report](get-balance-report) endpoint or the
[balance transactions](list-balance-transactions) endpoint.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-settlement" method="get" path="/v2/settlements/{settlementId}" example="get-settlement-200-1" -->
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



$response = $sdk->settlements->get(
    settlementId: 'stl_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entitySettlement !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `settlementId`                                                                   | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related settlement.                                        | stl_5B8cwPMGnU                                                                   |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetSettlementResponse](../../Models/Operations/GetSettlementResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getOpen

Retrieve the details of the open balance of the organization. This will return a settlement object representing your
organization's balance.

For a complete reference of the settlement object, refer to the [Get settlement endpoint](get-settlement)
documentation.

For more accurate bookkeeping, refer to the [balance report](get-balance-report) endpoint or the
[balance transactions](list-balance-transactions) endpoint.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-open-settlement" method="get" path="/v2/settlements/open" example="get-open-settlement-200-1" -->
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



$response = $sdk->settlements->getOpen(
    idempotencyKey: '123e4567-e89b-12d3-a456-426'
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetOpenSettlementResponse](../../Models/Operations/GetOpenSettlementResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getNext

Retrieve the details of the current settlement, that has not yet been paid out.

For a complete reference of the settlement object, refer to the [Get settlement endpoint](get-settlement)
documentation.

For more accurate bookkeeping, refer to the [balance report](get-balance-report) endpoint or the
[balance transactions](list-balance-transactions) endpoint.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-next-settlement" method="get" path="/v2/settlements/next" example="get-next-settlement-200-1" -->
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



$response = $sdk->settlements->getNext(
    idempotencyKey: '123e4567-e89b-12d3-a456-426'
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetNextSettlementResponse](../../Models/Operations/GetNextSettlementResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listPayments

Retrieve all payments included in the given settlement.

The response is in the same format as the response of the [List payments endpoint](list-payments).

For capture-based payment methods such as Klarna, the payments are not listed here. Refer to the
[List captures endpoint](list-captures) endpoint instead.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-settlement-payments" method="get" path="/v2/settlements/{settlementId}/payments" example="list-settlement-payments-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListSettlementPaymentsRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                            | Type                                                                                                 | Required                                                                                             | Description                                                                                          |
| ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| `$request`                                                                                           | [Operations\ListSettlementPaymentsRequest](../../Models/Operations/ListSettlementPaymentsRequest.md) | :heavy_check_mark:                                                                                   | The request object to use for the request.                                                           |

### Response

**[?Operations\ListSettlementPaymentsResponse](../../Models/Operations/ListSettlementPaymentsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listCaptures

Retrieve all captures included in the given settlement.

The response is in the same format as the response of the [List captures endpoint](list-captures).

### Example Usage

<!-- UsageSnippet language="php" operationID="list-settlement-captures" method="get" path="/v2/settlements/{settlementId}/captures" example="list-settlement-captures-200-1" -->
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

$request = new Operations\ListSettlementCapturesRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 'cpt_vytxeTZskVKR7C7WgdSP3d',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listCaptures(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                            | Type                                                                                                 | Required                                                                                             | Description                                                                                          |
| ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| `$request`                                                                                           | [Operations\ListSettlementCapturesRequest](../../Models/Operations/ListSettlementCapturesRequest.md) | :heavy_check_mark:                                                                                   | The request object to use for the request.                                                           |

### Response

**[?Operations\ListSettlementCapturesResponse](../../Models/Operations/ListSettlementCapturesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listRefunds

Retrieve all refunds 'deducted' from the given settlement.

The response is in the same format as the response of the [List refunds endpoint](list-refunds).

### Example Usage

<!-- UsageSnippet language="php" operationID="list-settlement-refunds" method="get" path="/v2/settlements/{settlementId}/refunds" example="list-settlement-refunds-200-1" -->
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

$request = new Operations\ListSettlementRefundsRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 're_5B8cwPMGnU',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listRefunds(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                          | Type                                                                                               | Required                                                                                           | Description                                                                                        |
| -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------- |
| `$request`                                                                                         | [Operations\ListSettlementRefundsRequest](../../Models/Operations/ListSettlementRefundsRequest.md) | :heavy_check_mark:                                                                                 | The request object to use for the request.                                                         |

### Response

**[?Operations\ListSettlementRefundsResponse](../../Models/Operations/ListSettlementRefundsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listChargebacks

Retrieve all chargebacks 'deducted' from the given settlement.

The response is in the same format as the response of the [List chargebacks endpoint](list-chargebacks).

### Example Usage: list-chargeback-200-1

<!-- UsageSnippet language="php" operationID="list-settlement-chargebacks" method="get" path="/v2/settlements/{settlementId}/chargebacks" example="list-chargeback-200-1" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListSettlementChargebacksRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listChargebacks(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-chargeback-200-2

<!-- UsageSnippet language="php" operationID="list-settlement-chargebacks" method="get" path="/v2/settlements/{settlementId}/chargebacks" example="list-chargeback-200-2" -->
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
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListSettlementChargebacksRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listChargebacks(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-chargeback-200-3

<!-- UsageSnippet language="php" operationID="list-settlement-chargebacks" method="get" path="/v2/settlements/{settlementId}/chargebacks" example="list-chargeback-200-3" -->
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

$request = new Operations\ListSettlementChargebacksRequest(
    settlementId: 'stl_5B8cwPMGnU',
    from: 'chb_xFzwUN4ci8HAmSGUACS4J',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->settlements->listChargebacks(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                                  | Type                                                                                                       | Required                                                                                                   | Description                                                                                                |
| ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                 | [Operations\ListSettlementChargebacksRequest](../../Models/Operations/ListSettlementChargebacksRequest.md) | :heavy_check_mark:                                                                                         | The request object to use for the request.                                                                 |

### Response

**[?Operations\ListSettlementChargebacksResponse](../../Models/Operations/ListSettlementChargebacksResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |