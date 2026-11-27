# Mandates

## Overview

### Available Operations

* [create](#create) - Create mandate
* [list](#list) - List mandates
* [get](#get) - Get mandate
* [revoke](#revoke) - Revoke mandate

## create

Create a mandate for a specific customer. Mandates allow you to charge a customer's card, PayPal account or bank
account recurrently.

It is only possible to create mandates for IBANs and PayPal billing agreements with this endpoint. To create
mandates for cards, your customers need to perform a 'first payment' with their card.

### Example Usage: create-mandate-201-1

<!-- UsageSnippet language="php" operationID="create-mandate" method="post" path="/v2/customers/{customerId}/mandates" example="create-mandate-201-1" -->
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

$request = new Operations\CreateMandateRequest(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: new Components\MandateRequest(
        id: 'mdt_5B8cwPMGnU',
        method: Components\MandateMethod::Directdebit,
        consumerName: 'John Doe',
        consumerAccount: 'NL55INGB0000000000',
        consumerBic: 'BANKBIC',
        consumerEmail: 'example@email.com',
        signatureDate: '2025-01-01',
        mandateReference: 'ID-1023892',
        paypalBillingAgreementId: 'B-12A34567B8901234CD',
        payPalVaultId: '8kk8451t',
        testmode: false,
    ),
);

$response = $sdk->mandates->create(
    request: $request
);

if ($response->mandateResponse !== null) {
    // handle response
}
```
### Example Usage: create-mandate-201-2

<!-- UsageSnippet language="php" operationID="create-mandate" method="post" path="/v2/customers/{customerId}/mandates" example="create-mandate-201-2" -->
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

$request = new Operations\CreateMandateRequest(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: new Components\MandateRequest(
        id: 'mdt_5B8cwPMGnU',
        method: Components\MandateMethod::Directdebit,
        consumerName: 'John Doe',
        consumerAccount: 'NL55INGB0000000000',
        consumerBic: 'BANKBIC',
        consumerEmail: 'example@email.com',
        signatureDate: '2025-01-01',
        mandateReference: 'ID-1023892',
        paypalBillingAgreementId: 'B-12A34567B8901234CD',
        payPalVaultId: '8kk8451t',
        testmode: false,
    ),
);

$response = $sdk->mandates->create(
    request: $request
);

if ($response->mandateResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\CreateMandateRequest](../../Models/Operations/CreateMandateRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\CreateMandateResponse](../../Models/Operations/CreateMandateResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve a list of all mandates.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-mandates" method="get" path="/v2/customers/{customerId}/mandates" example="list-mandates-200-1" -->
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

$request = new Operations\ListMandatesRequest(
    customerId: 'cst_5B8cwPMGnU',
    from: 'mdt_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    scopes: [
        Components\MandateScopes::CustomerPresent,
    ],
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->mandates->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Operations\ListMandatesRequest](../../Models/Operations/ListMandatesRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\ListMandatesResponse](../../Models/Operations/ListMandatesResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single mandate by its ID. Depending on the type of mandate, the object will contain the customer's bank
account details, card details, or PayPal account details.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-mandate" method="get" path="/v2/customers/{customerId}/mandates/{mandateId}" example="get-mandate-200-1" -->
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

$request = new Operations\GetMandateRequest(
    customerId: 'cst_5B8cwPMGnU',
    mandateId: 'mdt_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$response = $sdk->mandates->get(
    request: $request
);

if ($response->mandateResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                    | Type                                                                         | Required                                                                     | Description                                                                  |
| ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------------------- |
| `$request`                                                                   | [Operations\GetMandateRequest](../../Models/Operations/GetMandateRequest.md) | :heavy_check_mark:                                                           | The request object to use for the request.                                   |

### Response

**[?Operations\GetMandateResponse](../../Models/Operations/GetMandateResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## revoke

Revoke a customer's mandate. You will no longer be able to charge the customer's bank account or card with this
mandate, and all connected subscriptions will be canceled.

### Example Usage

<!-- UsageSnippet language="php" operationID="revoke-mandate" method="delete" path="/v2/customers/{customerId}/mandates/{mandateId}" -->
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

$request = new Operations\RevokeMandateRequest(
    customerId: 'cst_5B8cwPMGnU',
    mandateId: 'mdt_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
    body: new Operations\RevokeMandateRequestBody(
        testmode: false,
    ),
);

$response = $sdk->mandates->revoke(
    request: $request
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\RevokeMandateRequest](../../Models/Operations/RevokeMandateRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\RevokeMandateResponse](../../Models/Operations/RevokeMandateResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |