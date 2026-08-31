# Terminals

## Overview

### Available Operations

* [list](#list) - List terminals
* [get](#get) - Get terminal
* [terminalsRequestPairingCode](#terminalsrequestpairingcode) - Request terminal pairing code
* [terminalsListPairingCodes](#terminalslistpairingcodes) - List terminal pairing codes
* [terminalsGetPairingCode](#terminalsgetpairingcode) - Get terminal pairing code
* [terminalsRevokePairingCode](#terminalsrevokepairingcode) - Revoke terminal pairing code

## list

Retrieve a list of all physical point-of-sale devices.

The results are paginated.

### Example Usage: list-terminals-200-1

<!-- UsageSnippet language="php" operationID="list-terminals" method="get" path="/v2/terminals" example="list-terminals-200-1" -->
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

$request = new Operations\ListTerminalsRequest(
    from: 'term_vytxeTZskVKR7C7WgdSP3d',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->terminals->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-terminals-200-2

<!-- UsageSnippet language="php" operationID="list-terminals" method="get" path="/v2/terminals" example="list-terminals-200-2" -->
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

$request = new Operations\ListTerminalsRequest(
    from: 'term_vytxeTZskVKR7C7WgdSP3d',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->terminals->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\ListTerminalsRequest](../../Models/Operations/ListTerminalsRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\ListTerminalsResponse](../../Models/Operations/ListTerminalsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single terminal by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-terminal" method="get" path="/v2/terminals/{terminalId}" example="get-terminal-200-1" -->
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



$response = $sdk->terminals->get(
    terminalId: 'term_vytxeTZskVKR7C7WgdSP3d',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityTerminal !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `terminalId`                                                                                                                                                                                                                                                                                                                                                                             | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related terminal.                                                                                                                                                                                                                                                                                                                                                  | term_vytxeTZskVKR7C7WgdSP3d                                                                                                                                                                                                                                                                                                                                                              |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetTerminalResponse](../../Models/Operations/GetTerminalResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## terminalsRequestPairingCode

> ℹ️ **Test mode**
>
> This endpoint currently does not support test mode yet.

Request a pairing code to onboard a point-of-sale terminal.

The response includes a human-readable `code` for manual entry on the terminal, and a QR Code as a
base64 encoded SVG data URI for scanning if you specify the query parameter `include` with value `details.qrCode`.

Pairing codes expire after 90 days (see `expiresAt`) and can be used multiple times.

### Example Usage

<!-- UsageSnippet language="php" operationID="terminals-request-pairing-code" method="post" path="/v2/terminals/pairing-codes" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$body = new Operations\TerminalsRequestPairingCodeRequestBody(
    profileId: 'pfl_jA9bC4DkFj3G',
);

$response = $sdk->terminals->terminalsRequestPairingCode(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->entityPairingCode !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                               | Type                                                                                                                    | Required                                                                                                                | Description                                                                                                             | Example                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| `include`                                                                                                               | *?string*                                                                                                               | :heavy_minus_sign:                                                                                                      | Include additional information in the response.                                                                         |                                                                                                                         |
| `idempotencyKey`                                                                                                        | *?string*                                                                                                               | :heavy_minus_sign:                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                        | 123e4567-e89b-12d3-a456-426                                                                                             |
| `body`                                                                                                                  | [?Operations\TerminalsRequestPairingCodeRequestBody](../../Models/Operations/TerminalsRequestPairingCodeRequestBody.md) | :heavy_minus_sign:                                                                                                      | N/A                                                                                                                     |                                                                                                                         |

### Response

**[?Operations\TerminalsRequestPairingCodeResponse](../../Models/Operations/TerminalsRequestPairingCodeResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 403, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## terminalsListPairingCodes

> ℹ️ **Test mode**
>
> This endpoint currently does not support test mode yet.

Returns your pairing codes: `active`, `expired`, and `revoked`. Results are paginated.

We keep a pairing code for one month after it is revoked or expires, then delete it. Deleted codes drop out of
this list. Active pairing codes are never deleted.

### Example Usage

<!-- UsageSnippet language="php" operationID="terminals-list-pairing-codes" method="get" path="/v2/terminals/pairing-codes" -->
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
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\TerminalsListPairingCodesRequest(
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->terminals->terminalsListPairingCodes(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                  | Type                                                                                                       | Required                                                                                                   | Description                                                                                                |
| ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                                 | [Operations\TerminalsListPairingCodesRequest](../../Models/Operations/TerminalsListPairingCodesRequest.md) | :heavy_check_mark:                                                                                         | The request object to use for the request.                                                                 |

### Response

**[?Operations\TerminalsListPairingCodesResponse](../../Models/Operations/TerminalsListPairingCodesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## terminalsGetPairingCode

> ℹ️ **Test mode**
>
> This endpoint currently does not support test mode yet.

Get a pairing code to onboard a point-of-sale terminal.

The response includes a human-readable `code` for manual entry on the terminal and, optionally, a QR Code as a
base64 encoded SVG data URI when you use the `include` query parameter with value `details.qrCode`.

We keep a pairing code for one month after it is revoked or expires, then delete it. Once deleted, this endpoint
returns a 404. Active pairing codes are never deleted.

### Example Usage

<!-- UsageSnippet language="php" operationID="terminals-get-pairing-code" method="get" path="/v2/terminals/pairing-codes/{pairingCodeId}" -->
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



$response = $sdk->terminals->terminalsGetPairingCode(
    pairingCodeId: 'termpc_R7gX5Ea9bC4DkFj3G',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityPairingCode !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `pairingCodeId`                                                                  | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the terminal pairing code.                                     | termpc_R7gX5Ea9bC4DkFj3G                                                         |
| `include`                                                                        | *?string*                                                                        | :heavy_minus_sign:                                                               | Include additional information in the response.                                  |                                                                                  |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\TerminalsGetPairingCodeResponse](../../Models/Operations/TerminalsGetPairingCodeResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## terminalsRevokePairingCode

> ℹ️ **Test mode**
>
> This endpoint currently does not support test mode yet.

Revoke a pairing code, preventing the onboarding of new point-of-sale terminals.

Terminals that have already paired with this code are not affected.

We keep a revoked pairing code for one month, then delete it. Once deleted, this endpoint returns a 404.

### Example Usage

<!-- UsageSnippet language="php" operationID="terminals-revoke-pairing-code" method="delete" path="/v2/terminals/pairing-codes/{pairingCodeId}" -->
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



$response = $sdk->terminals->terminalsRevokePairingCode(
    pairingCodeId: 'termpc_R7gX5Ea9bC4DkFj3G',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityPairingCode !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `pairingCodeId`                                                                  | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the terminal pairing code.                                     | termpc_R7gX5Ea9bC4DkFj3G                                                         |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\TerminalsRevokePairingCodeResponse](../../Models/Operations/TerminalsRevokePairingCodeResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |