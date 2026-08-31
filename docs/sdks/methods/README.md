# Methods

## Overview

### Available Operations

* [list](#list) - List payment methods
* [all](#all) - List all payment methods
* [get](#get) - Get payment method
* [enable](#enable) - Enable payment method
* [disable](#disable) - Disable payment method
* [enableIssuer](#enableissuer) - Enable payment method issuer
* [disableIssuer](#disableissuer) - Disable payment method issuer

## list

Retrieve all enabled payment methods. The results of this endpoint are
**not** paginated — unlike most other list endpoints in our API.

For test mode, all pending and enabled payment methods are returned. If no
payment methods are requested yet, the most popular payment methods are returned in the test mode. For live
mode, only fully enabled payment methods are returned.

Payment methods can be requested and enabled via the Mollie Dashboard, or
via the [Enable payment method endpoint](enable-method) of the Profiles API.

The list can optionally be filtered using a number of parameters described
below.

By default, only payment methods for the Euro currency are returned. If you
wish to retrieve payment methods which exclusively support other currencies (e.g. Twint), you need to use the
`amount` parameters.

ℹ️ **Note:** This endpoint only returns **online** payment methods. If you wish to retrieve the information about
a non-online payment method, you can use the [Get payment method endpoint](get-method).

### Example Usage: list-method-200-3

<!-- UsageSnippet language="php" operationID="list-methods" method="get" path="/v2/methods" example="list-method-200-3" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListMethodsRequest(
    sequenceType: Components\SequenceType::Oneoff,
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    billingCountry: 'DE',
    includeWallets: Components\MethodIncludeWalletsParameter::Applepay,
    orderLineCategories: Components\LineCategories::Eco,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->list(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: list-methods-200-1

<!-- UsageSnippet language="php" operationID="list-methods" method="get" path="/v2/methods" example="list-methods-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListMethodsRequest(
    sequenceType: Components\SequenceType::Oneoff,
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    billingCountry: 'DE',
    includeWallets: Components\MethodIncludeWalletsParameter::Applepay,
    orderLineCategories: Components\LineCategories::Eco,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->list(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: list-methods-200-2

<!-- UsageSnippet language="php" operationID="list-methods" method="get" path="/v2/methods" example="list-methods-200-2" -->
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

$request = new Operations\ListMethodsRequest(
    sequenceType: Components\SequenceType::Oneoff,
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    billingCountry: 'DE',
    includeWallets: Components\MethodIncludeWalletsParameter::Applepay,
    orderLineCategories: Components\LineCategories::Eco,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->list(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                      | Type                                                                           | Required                                                                       | Description                                                                    |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `$request`                                                                     | [Operations\ListMethodsRequest](../../Models/Operations/ListMethodsRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\ListMethodsResponse](../../Models/Operations/ListMethodsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## all

Retrieve all payment methods that Mollie offers, regardless of the eligibility of the organization for the specific
method. The results of this endpoint are **not** paginated — unlike most other list endpoints in our API.

The list can optionally be filtered using a number of parameters described below.

ℹ️ **Note:** This endpoint only returns **online** payment methods. If you wish to retrieve the information about
a non-online payment method, you can use the [Get payment method endpoint](get-method).

### Example Usage: list-all-methods-200-1

<!-- UsageSnippet language="php" operationID="list-all-methods" method="get" path="/v2/methods/all" example="list-all-methods-200-1" -->
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

$request = new Operations\ListAllMethodsRequest(
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    sequenceType: Components\SequenceType::Oneoff,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->all(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: list-all-methods-200-2

<!-- UsageSnippet language="php" operationID="list-all-methods" method="get" path="/v2/methods/all" example="list-all-methods-200-2" -->
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

$request = new Operations\ListAllMethodsRequest(
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    sequenceType: Components\SequenceType::Oneoff,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->all(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: list-all-methods-200-3

<!-- UsageSnippet language="php" operationID="list-all-methods" method="get" path="/v2/methods/all" example="list-all-methods-200-3" -->
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

$request = new Operations\ListAllMethodsRequest(
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    sequenceType: Components\SequenceType::Oneoff,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->all(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```
### Example Usage: list-all-methods-200-4

<!-- UsageSnippet language="php" operationID="list-all-methods" method="get" path="/v2/methods/all" example="list-all-methods-200-4" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListAllMethodsRequest(
    locale: Components\Locale::EnUS,
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    sequenceType: Components\SequenceType::Oneoff,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->all(
    request: $request
);

if ($response->object !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                            | Type                                                                                 | Required                                                                             | Description                                                                          |
| ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------ |
| `$request`                                                                           | [Operations\ListAllMethodsRequest](../../Models/Operations/ListAllMethodsRequest.md) | :heavy_check_mark:                                                                   | The request object to use for the request.                                           |

### Response

**[?Operations\ListAllMethodsResponse](../../Models/Operations/ListAllMethodsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single payment method by its ID.

If a method is not available on this profile, a `404 Not Found` response is
returned. If the method is available but not enabled yet, a status `403 Forbidden` is returned. You can enable
payments methods via the [Enable payment method endpoint](enable-method) of the Profiles API, or via
the Mollie Dashboard.

If you do not know the method's ID, you can use the [methods list
endpoint](list-methods) to retrieve all payment methods that are available.

Additionally, it is possible to check if wallet methods such as Apple Pay
are enabled by passing the wallet ID (`applepay`) as the method ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-method" method="get" path="/v2/methods/{methodId}" example="get-method-200-1" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setProfileId('<id>')
    ->setTestmode(false)
    ->setSecurity(
        new Components\Security(
            apiKey: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\GetMethodRequest(
    methodId: Components\MethodEnum::Ideal,
    locale: Components\Locale::EnUS,
    currency: 'EUR',
    sequenceType: Components\SequenceType::Oneoff,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$response = $sdk->methods->get(
    request: $request
);

if ($response->entityMethodGet !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                  | Type                                                                       | Required                                                                   | Description                                                                |
| -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `$request`                                                                 | [Operations\GetMethodRequest](../../Models/Operations/GetMethodRequest.md) | :heavy_check_mark:                                                         | The request object to use for the request.                                 |

### Response

**[?Operations\GetMethodResponse](../../Models/Operations/GetMethodResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## enable

Enable a payment method on a specific profile.

When using a profile-specific API credential, the alias `me` can be used
instead of the profile ID to refer to the current profile.

Some payment methods require extra steps in order to be activated. In cases
where a step at the payment method provider needs to be completed first, the status will be set to
`pending-external` and the response will contain a link to complete the activation at the provider.

To enable voucher or gift card issuers, refer to the [Enable payment method issuer](enable-method-issuer) endpoint.

### Example Usage: enable-method-200-1

<!-- UsageSnippet language="php" operationID="enable-method" method="post" path="/v2/profiles/{profileId}/methods/{methodId}" example="enable-method-200-1" -->
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



$response = $sdk->methods->enable(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodEnum::Ideal,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityMethodGet !== null) {
    // handle response
}
```
### Example Usage: enable-method-200-2

<!-- UsageSnippet language="php" operationID="enable-method" method="post" path="/v2/profiles/{profileId}/methods/{methodId}" example="enable-method-200-2" -->
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



$response = $sdk->methods->enable(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodEnum::Ideal,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityMethodGet !== null) {
    // handle response
}
```
### Example Usage: enable-method-200-3

<!-- UsageSnippet language="php" operationID="enable-method" method="post" path="/v2/profiles/{profileId}/methods/{methodId}" example="enable-method-200-3" -->
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



$response = $sdk->methods->enable(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodEnum::Ideal,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->entityMethodGet !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `profileId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related profile.                                           | pfl_5B8cwPMGnU                                                                   |
| `methodId`                                                                       | [Components\MethodEnum](../../Models/Components/MethodEnum.md)                   | :heavy_check_mark:                                                               | Provide the ID of the related payment method.                                    | ideal                                                                            |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\EnableMethodResponse](../../Models/Operations/EnableMethodResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## disable

Disable a payment method on a specific profile.

When using a profile-specific API credential, the alias `me` can be used
instead of the profile ID to refer to the current profile.

### Example Usage

<!-- UsageSnippet language="php" operationID="disable-method" method="delete" path="/v2/profiles/{profileId}/methods/{methodId}" -->
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



$response = $sdk->methods->disable(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodEnum::Ideal,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `profileId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related profile.                                           | pfl_5B8cwPMGnU                                                                   |
| `methodId`                                                                       | [Components\MethodEnum](../../Models/Components/MethodEnum.md)                   | :heavy_check_mark:                                                               | Provide the ID of the related payment method.                                    | ideal                                                                            |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\DisableMethodResponse](../../Models/Operations/DisableMethodResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## enableIssuer

Enable an issuer for a payment method on a specific profile.

Currently only the payment methods `voucher` and `giftcard` are supported.

When using a profile-specific API credential, the alias `me` can be used instead of the profile ID to refer to the
current profile.

### Example Usage

<!-- UsageSnippet language="php" operationID="enable-method-issuer" method="post" path="/v2/profiles/{profileId}/methods/{methodId}/issuers/{issuerId}" example="enable-method-issuer-200-1" -->
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

$request = new Operations\EnableMethodIssuerRequest(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodIdWithIssuer::Voucher,
    issuerId: 'edenred-france-sports',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: new Operations\EnableMethodIssuerRequestBody(
        contractId: 'ideal',
    ),
);

$response = $sdk->methods->enableIssuer(
    request: $request
);

if ($response->oneOf !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `$request`                                                                                   | [Operations\EnableMethodIssuerRequest](../../Models/Operations/EnableMethodIssuerRequest.md) | :heavy_check_mark:                                                                           | The request object to use for the request.                                                   |

### Response

**[?Operations\EnableMethodIssuerResponse](../../Models/Operations/EnableMethodIssuerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## disableIssuer

Disable an issuer for a payment method on a specific profile.

Currently only the payment methods `voucher` and `giftcard` are supported.

When using a profile-specific API credential, the alias `me` can be used instead of the profile ID to refer to the
current profile.

### Example Usage

<!-- UsageSnippet language="php" operationID="disable-method-issuer" method="delete" path="/v2/profiles/{profileId}/methods/{methodId}/issuers/{issuerId}" -->
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



$response = $sdk->methods->disableIssuer(
    profileId: 'pfl_5B8cwPMGnU',
    methodId: Components\MethodIdWithIssuer::Voucher,
    issuerId: 'edenred-france-sports',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `profileId`                                                                      | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related profile.                                           | pfl_5B8cwPMGnU                                                                   |
| `methodId`                                                                       | [Components\MethodIdWithIssuer](../../Models/Components/MethodIdWithIssuer.md)   | :heavy_check_mark:                                                               | Provide the ID of the related payment method.                                    | voucher                                                                          |
| `issuerId`                                                                       | *string*                                                                         | :heavy_check_mark:                                                               | Provide the ID of the related issuer.                                            | edenred-france-sports                                                            |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\DisableMethodIssuerResponse](../../Models/Operations/DisableMethodIssuerResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |