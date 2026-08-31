# Profiles

## Overview

### Available Operations

* [create](#create) - Create profile
* [list](#list) - List profiles
* [get](#get) - Get profile
* [update](#update) - Update profile
* [delete](#delete) - Delete profile
* [getCurrent](#getcurrent) - Get current profile

## create

Create a profile to process payments on.

Profiles are required for payment processing. Normally they are created via the Mollie dashboard. Alternatively, you
can use this endpoint to automate profile creation.

### Example Usage: create-profile-201-1

<!-- UsageSnippet language="php" operationID="create-profile" method="post" path="/v2/profiles" example="create-profile-201-1" -->
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

$body = new Components\ProfileRequest(
    name: 'My website name',
    website: 'https://example.com',
    email: 'test@mollie.com',
    phone: '+31208202070',
    description: 'My website description',
    countriesOfActivity: [
        'NL',
        'GB',
    ],
    businessCategory: 'OTHER_MERCHANDISE',
);

$response = $sdk->profiles->create(
    body: $body,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->profileResponse !== null) {
    // handle response
}
```
### Example Usage: create-profile-201-2

<!-- UsageSnippet language="php" operationID="create-profile" method="post" path="/v2/profiles" example="create-profile-201-2" -->
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

$body = new Components\ProfileRequest(
    name: 'My website name',
    website: 'https://example.com',
    email: 'test@mollie.com',
    phone: '+31208202070',
    description: 'My website description',
    countriesOfActivity: [
        'NL',
        'GB',
    ],
    businessCategory: 'OTHER_MERCHANDISE',
);

$response = $sdk->profiles->create(
    body: $body,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->profileResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `body`                                                                           | [Components\ProfileRequest](../../Models/Components/ProfileRequest.md)           | :heavy_check_mark:                                                               | N/A                                                                              |                                                                                  |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\CreateProfileResponse](../../Models/Operations/CreateProfileResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 403, 422, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all of your profiles.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-profiles" method="get" path="/v2/profiles" example="list-profiles-200-1" -->
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



$responses = $sdk->profiles->list(
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

| Parameter                                                                                                                      | Type                                                                                                                           | Required                                                                                                                       | Description                                                                                                                    | Example                                                                                                                        |
| ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------ |
| `from`                                                                                                                         | *?string*                                                                                                                      | :heavy_minus_sign:                                                                                                             | Provide an ID to start the result set from the item with the given ID and onwards. This allows you to paginate the<br/>result set. |                                                                                                                                |
| `limit`                                                                                                                        | *?int*                                                                                                                         | :heavy_minus_sign:                                                                                                             | The maximum number of items to return. Defaults to 50 items.                                                                   | 50                                                                                                                             |
| `idempotencyKey`                                                                                                               | *?string*                                                                                                                      | :heavy_minus_sign:                                                                                                             | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                               | 123e4567-e89b-12d3-a456-426                                                                                                    |

### Response

**[?Operations\ListProfilesResponse](../../Models/Operations/ListProfilesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single profile by its ID.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-profile" method="get" path="/v2/profiles/{profileId}" example="get-profile-200-1" -->
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



$response = $sdk->profiles->get(
    profileId: 'pfl_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->profileResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                               | Type                                                                                                                                                                    | Required                                                                                                                                                                | Description                                                                                                                                                             | Example                                                                                                                                                                 |
| ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `profileId`                                                                                                                                                             | *string*                                                                                                                                                                | :heavy_check_mark:                                                                                                                                                      | Provide the ID of the related profile.                                                                                                                                  | pfl_5B8cwPMGnU                                                                                                                                                          |
| `testmode`                                                                                                                                                              | *?bool*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                      | You can enable test mode by setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                         |
| `idempotencyKey`                                                                                                                                                        | *?string*                                                                                                                                                               | :heavy_minus_sign:                                                                                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                        | 123e4567-e89b-12d3-a456-426                                                                                                                                             |

### Response

**[?Operations\GetProfileResponse](../../Models/Operations/GetProfileResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 410, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Update an existing profile.

Profiles are required for payment processing. Normally they are created and updated via the Mollie dashboard.
Alternatively, you can use this endpoint to automate profile management.

### Example Usage: update-profile-200-1

<!-- UsageSnippet language="php" operationID="update-profile" method="patch" path="/v2/profiles/{profileId}" example="update-profile-200-1" -->
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

$body = new Operations\UpdateProfileRequestBody(
    name: 'My new website name',
    website: 'https://example.com',
    email: 'test@mollie.com',
    phone: '+31208202071',
    description: 'My website description',
    countriesOfActivity: [
        'NL',
        'GB',
    ],
    businessCategory: 'OTHER_MERCHANDISE',
);

$response = $sdk->profiles->update(
    profileId: 'pfl_5B8cwPMGnU',
    body: $body,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->profileResponse !== null) {
    // handle response
}
```
### Example Usage: update-profile-200-2

<!-- UsageSnippet language="php" operationID="update-profile" method="patch" path="/v2/profiles/{profileId}" example="update-profile-200-2" -->
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

$body = new Operations\UpdateProfileRequestBody(
    name: 'My new website name',
    website: 'https://example.com',
    email: 'test@mollie.com',
    phone: '+31208202071',
    description: 'My website description',
    countriesOfActivity: [
        'NL',
        'GB',
    ],
    businessCategory: 'OTHER_MERCHANDISE',
);

$response = $sdk->profiles->update(
    profileId: 'pfl_5B8cwPMGnU',
    body: $body,
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->profileResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                | Example                                                                                    |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `profileId`                                                                                | *string*                                                                                   | :heavy_check_mark:                                                                         | Provide the ID of the related profile.                                                     | pfl_5B8cwPMGnU                                                                             |
| `body`                                                                                     | [Operations\UpdateProfileRequestBody](../../Models/Operations/UpdateProfileRequestBody.md) | :heavy_check_mark:                                                                         | N/A                                                                                        |                                                                                            |
| `idempotencyKey`                                                                           | *?string*                                                                                  | :heavy_minus_sign:                                                                         | A unique key to ensure idempotent requests. This key should be a UUID v4 string.           | 123e4567-e89b-12d3-a456-426                                                                |

### Response

**[?Operations\UpdateProfileResponse](../../Models/Operations/UpdateProfileResponse.md)**

### Errors

| Error Type              | Status Code             | Content Type            |
| ----------------------- | ----------------------- | ----------------------- |
| Errors\ErrorResponse    | 403, 404, 410, 422, 429 | application/hal+json    |
| Errors\APIException     | 4XX, 5XX                | \*/\*                   |

## delete

Delete a profile. A deleted profile and its related credentials can no longer be used for accepting payments.

### Example Usage

<!-- UsageSnippet language="php" operationID="delete-profile" method="delete" path="/v2/profiles/{profileId}" -->
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



$response = $sdk->profiles->delete(
    profileId: 'pfl_5B8cwPMGnU',
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
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\DeleteProfileResponse](../../Models/Operations/DeleteProfileResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 410, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## getCurrent

Retrieve the currently authenticated profile. A convenient alias of the [Get profile](get-profile)
endpoint.

For a complete reference of the profile object, refer to the [Get profile](get-profile) endpoint
documentation.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-current-profile" method="get" path="/v2/profiles/me" example="get-current-profile-200-1" -->
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



$response = $sdk->profiles->getCurrent(
    idempotencyKey: '123e4567-e89b-12d3-a456-426'
);

if ($response->profileResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetCurrentProfileResponse](../../Models/Operations/GetCurrentProfileResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |