# Subscriptions

## Overview

### Available Operations

* [create](#create) - Create subscription
* [list](#list) - List customer subscriptions
* [get](#get) - Get subscription
* [update](#update) - Update subscription
* [cancel](#cancel) - Cancel subscription
* [all](#all) - List all subscriptions
* [listPayments](#listpayments) - List subscription payments

## create

With subscriptions, you can schedule recurring payments to take place at regular intervals.

For example, by simply specifying an `amount` and an `interval`, you can create an endless subscription to charge a
monthly fee, until you cancel the subscription.

Or, you could use the times parameter to only charge a limited number of times, for example to split a big
transaction in multiple parts.

A few example usages:

`amount[currency]="EUR"` `amount[value]="5.00"` `interval="2 weeks"`
Your customer will be charged €5 once every two weeks.

`amount[currency]="EUR"` `amount[value]="20.00"` `interval="1 day" times=5`
Your customer will be charged €20 every day, for five consecutive days.

`amount[currency]="EUR"` `amount[value]="10.00"` `interval="1 month"`
`startDate="2018-04-30"`
Your customer will be charged €10 on the last day of each month, starting in April 2018.

### Example Usage

<!-- UsageSnippet language="php" operationID="create-subscription" method="post" path="/v2/customers/{customerId}/subscriptions" example="get-subscription-200-1" -->
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

$body = new Components\SubscriptionRequest(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    times: 6,
    interval: '2 days',
    startDate: '2025-01-01',
    description: 'Subscription of streaming channel',
    method: Components\SubscriptionMethod::Paypal,
    applicationFee: new Components\SubscriptionRequestApplicationFee(
        amount: new Components\Amount(
            currency: 'EUR',
            value: '10.00',
        ),
        description: 'Platform fee',
    ),
    webhookUrl: 'https://example.com/webhook',
    mandateId: 'mdt_5B8cwPMGnU',
    profileId: 'pfl_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->subscriptions->create(
    customerId: 'cst_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->subscriptionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                         | Type                                                                              | Required                                                                          | Description                                                                       | Example                                                                           |
| --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- |
| `customerId`                                                                      | *string*                                                                          | :heavy_check_mark:                                                                | Provide the ID of the related customer.                                           | cst_5B8cwPMGnU                                                                    |
| `idempotencyKey`                                                                  | *?string*                                                                         | :heavy_minus_sign:                                                                | A unique key to ensure idempotent requests. This key should be a UUID v4 string.  | 123e4567-e89b-12d3-a456-426                                                       |
| `body`                                                                            | [?Components\SubscriptionRequest](../../Models/Components/SubscriptionRequest.md) | :heavy_minus_sign:                                                                | N/A                                                                               |                                                                                   |

### Response

**[?Operations\CreateSubscriptionResponse](../../Models/Operations/CreateSubscriptionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## list

Retrieve all subscriptions of a customer.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-subscriptions" method="get" path="/v2/customers/{customerId}/subscriptions" example="list-subscriptions-200-1" -->
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

$request = new Operations\ListSubscriptionsRequest(
    customerId: 'cst_5B8cwPMGnU',
    from: 'sub_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->subscriptions->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                  | Type                                                                                       | Required                                                                                   | Description                                                                                |
| ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------ |
| `$request`                                                                                 | [Operations\ListSubscriptionsRequest](../../Models/Operations/ListSubscriptionsRequest.md) | :heavy_check_mark:                                                                         | The request object to use for the request.                                                 |

### Response

**[?Operations\ListSubscriptionsResponse](../../Models/Operations/ListSubscriptionsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## get

Retrieve a single subscription by its ID and the ID of its parent customer.

### Example Usage

<!-- UsageSnippet language="php" operationID="get-subscription" method="get" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}" example="get-subscription-200-1" -->
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



$response = $sdk->subscriptions->get(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426'

);

if ($response->subscriptionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                                                                                                                                  |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `customerId`                                                                                                                                                                                                                                                                                                                                                                             | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related customer.                                                                                                                                                                                                                                                                                                                                                  | cst_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                           |
| `subscriptionId`                                                                                                                                                                                                                                                                                                                                                                         | *string*                                                                                                                                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                       | Provide the ID of the related subscription.                                                                                                                                                                                                                                                                                                                                              | sub_5B8cwPMGnU                                                                                                                                                                                                                                                                                                                                                                           |
| `testmode`                                                                                                                                                                                                                                                                                                                                                                               | *?bool*                                                                                                                                                                                                                                                                                                                                                                                  | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |                                                                                                                                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                       | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                                                                                                                                                                                                                                                                                                         | 123e4567-e89b-12d3-a456-426                                                                                                                                                                                                                                                                                                                                                              |

### Response

**[?Operations\GetSubscriptionResponse](../../Models/Operations/GetSubscriptionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## update

Update an existing subscription.

Canceled subscriptions cannot be updated.

For an in-depth explanation of each parameter, refer to the [Create subscription](create-subscription) endpoint.

### Example Usage: update-subscription-200-1

<!-- UsageSnippet language="php" operationID="update-subscription" method="patch" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}" example="update-subscription-200-1" -->
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

$body = new Operations\UpdateSubscriptionRequestBody(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Subscription of streaming channel',
    interval: '1 months',
    startDate: '2025-01-01',
    times: 6,
    webhookUrl: 'https://example.com/webhook',
    mandateId: 'mdt_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->subscriptions->update(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->subscriptionResponse !== null) {
    // handle response
}
```
### Example Usage: update-subscription-200-2

<!-- UsageSnippet language="php" operationID="update-subscription" method="patch" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}" example="update-subscription-200-2" -->
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

$body = new Operations\UpdateSubscriptionRequestBody(
    amount: new Components\Amount(
        currency: 'EUR',
        value: '10.00',
    ),
    description: 'Subscription of streaming channel',
    interval: '1 months',
    startDate: '2025-01-01',
    times: 6,
    webhookUrl: 'https://example.com/webhook',
    mandateId: 'mdt_5B8cwPMGnU',
    testmode: false,
);

$response = $sdk->subscriptions->update(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->subscriptionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                             | Type                                                                                                  | Required                                                                                              | Description                                                                                           | Example                                                                                               |
| ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- |
| `customerId`                                                                                          | *string*                                                                                              | :heavy_check_mark:                                                                                    | Provide the ID of the related customer.                                                               | cst_5B8cwPMGnU                                                                                        |
| `subscriptionId`                                                                                      | *string*                                                                                              | :heavy_check_mark:                                                                                    | Provide the ID of the related subscription.                                                           | sub_5B8cwPMGnU                                                                                        |
| `idempotencyKey`                                                                                      | *?string*                                                                                             | :heavy_minus_sign:                                                                                    | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                      | 123e4567-e89b-12d3-a456-426                                                                           |
| `body`                                                                                                | [?Operations\UpdateSubscriptionRequestBody](../../Models/Operations/UpdateSubscriptionRequestBody.md) | :heavy_minus_sign:                                                                                    | N/A                                                                                                   |                                                                                                       |

### Response

**[?Operations\UpdateSubscriptionResponse](../../Models/Operations/UpdateSubscriptionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## cancel

Cancel an existing subscription. Canceling a subscription has no effect on the mandates of the customer.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancel-subscription" method="delete" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}" example="cancel-subscription-200-1" -->
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

$body = new Operations\CancelSubscriptionRequestBody(
    testmode: false,
);

$response = $sdk->subscriptions->cancel(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->subscriptionResponse !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                             | Type                                                                                                  | Required                                                                                              | Description                                                                                           | Example                                                                                               |
| ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- |
| `customerId`                                                                                          | *string*                                                                                              | :heavy_check_mark:                                                                                    | Provide the ID of the related customer.                                                               | cst_5B8cwPMGnU                                                                                        |
| `subscriptionId`                                                                                      | *string*                                                                                              | :heavy_check_mark:                                                                                    | Provide the ID of the related subscription.                                                           | sub_5B8cwPMGnU                                                                                        |
| `idempotencyKey`                                                                                      | *?string*                                                                                             | :heavy_minus_sign:                                                                                    | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                      | 123e4567-e89b-12d3-a456-426                                                                           |
| `body`                                                                                                | [?Operations\CancelSubscriptionRequestBody](../../Models/Operations/CancelSubscriptionRequestBody.md) | :heavy_minus_sign:                                                                                    | N/A                                                                                                   |                                                                                                       |

### Response

**[?Operations\CancelSubscriptionResponse](../../Models/Operations/CancelSubscriptionResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 404, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## all

Retrieve all subscriptions initiated across all your customers.

The results are paginated.

### Example Usage

<!-- UsageSnippet language="php" operationID="list-all-subscriptions" method="get" path="/v2/subscriptions" example="list-subscriptions-200-1" -->
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

$request = new Operations\ListAllSubscriptionsRequest(
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->subscriptions->all(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                        | Type                                                                                             | Required                                                                                         | Description                                                                                      |
| ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------ |
| `$request`                                                                                       | [Operations\ListAllSubscriptionsRequest](../../Models/Operations/ListAllSubscriptionsRequest.md) | :heavy_check_mark:                                                                               | The request object to use for the request.                                                       |

### Response

**[?Operations\ListAllSubscriptionsResponse](../../Models/Operations/ListAllSubscriptionsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 404, 429        | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## listPayments

Retrieve all payments of a specific subscription.

The results are paginated.

### Example Usage: list-payments-200-1

<!-- UsageSnippet language="php" operationID="list-subscription-payments" method="get" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}/payments" example="list-payments-200-1" -->
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

$request = new Operations\ListSubscriptionPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->subscriptions->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-payments-200-2

<!-- UsageSnippet language="php" operationID="list-subscription-payments" method="get" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}/payments" example="list-payments-200-2" -->
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

$request = new Operations\ListSubscriptionPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->subscriptions->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: list-payments-200-3

<!-- UsageSnippet language="php" operationID="list-subscription-payments" method="get" path="/v2/customers/{customerId}/subscriptions/{subscriptionId}/payments" example="list-payments-200-3" -->
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

$request = new Operations\ListSubscriptionPaymentsRequest(
    customerId: 'cst_5B8cwPMGnU',
    subscriptionId: 'sub_5B8cwPMGnU',
    from: 'tr_5B8cwPMGnU',
    limit: 50,
    sort: Components\Sorting::Desc,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
);

$responses = $sdk->subscriptions->listPayments(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                                | Type                                                                                                     | Required                                                                                                 | Description                                                                                              |
| -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| `$request`                                                                                               | [Operations\ListSubscriptionPaymentsRequest](../../Models/Operations/ListSubscriptionPaymentsRequest.md) | :heavy_check_mark:                                                                                       | The request object to use for the request.                                                               |

### Response

**[?Operations\ListSubscriptionPaymentsResponse](../../Models/Operations/ListSubscriptionPaymentsResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 400, 429             | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |