# Onboarding

## Overview

### Available Operations

* [get](#get) - Get onboarding status
* [submit](#submit) - Submit onboarding data

## get

Retrieve the onboarding status of the currently authenticated organization.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-onboarding-status" method="get" path="/v2/onboarding/me" example="get-onboarding-status-200-1" -->
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



$response = $sdk->onboarding->get(
    idempotencyKey: '123e4567-e89b-12d3-a456-426'
);

if ($response->entityOnboardingStatus !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                 | *?string*                                                                        | :heavy_minus_sign:                                                               | A unique key to ensure idempotent requests. This key should be a UUID v4 string. | 123e4567-e89b-12d3-a456-426                                                      |

### Response

**[?Operations\GetOnboardingStatusResponse](../../Models/Operations/GetOnboardingStatusResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## submit

**⚠️ We no longer recommend implementing this endpoint. Please refer to the Client Links API instead to kick off the
onboarding process for your merchants.**

Submit data that will be prefilled in the merchant's onboarding. The data you submit will only be processed when the
onboarding status is `needs-data`.  
Information that the merchant has entered in their dashboard will not be overwritten.

### Example Usage

<!-- UsageSnippet language="php" operationID="submit-onboarding-data" method="post" path="/v2/onboarding/me" -->
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

$body = new Operations\SubmitOnboardingDataRequestBody(
    organization: new Operations\Organization(
        name: 'Mollie B.V.',
        address: new Components\Address(
            streetAndNumber: 'Keizersgracht 126',
            postalCode: '1015 CW',
            city: 'Amsterdam',
            country: 'NL',
        ),
        registrationNumber: '30204462',
        vatNumber: 'NL815839091B01',
        vatRegulation: Components\OnboardingVatRegulation::Dutch,
    ),
    profile: new Operations\Profile(
        name: 'Mollie',
        url: 'https://www.mollie.com',
        email: 'info@mollie.com',
        phone: '+31208202070',
        description: 'Payment service provider',
        businessCategory: 'MONEY_SERVICES',
    ),
);

$response = $sdk->onboarding->submit(
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                 | Type                                                                                                      | Required                                                                                                  | Description                                                                                               | Example                                                                                                   |
| --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                          | *?string*                                                                                                 | :heavy_minus_sign:                                                                                        | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                          | 123e4567-e89b-12d3-a456-426                                                                               |
| `body`                                                                                                    | [?Operations\SubmitOnboardingDataRequestBody](../../Models/Operations/SubmitOnboardingDataRequestBody.md) | :heavy_minus_sign:                                                                                        | N/A                                                                                                       |                                                                                                           |

### Response

**[?Operations\SubmitOnboardingDataResponse](../../Models/Operations/SubmitOnboardingDataResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |