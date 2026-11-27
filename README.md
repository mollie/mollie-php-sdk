# mollie/php

Developer-friendly & type-safe Php SDK specifically catered to leverage *mollie/php* API.

[![Built by Speakeasy](https://img.shields.io/badge/Built_by-SPEAKEASY-374151?style=for-the-badge&labelColor=f3f4f6)](https://www.speakeasy.com/?utm_source=mollie/php&utm_campaign=php)
[![License: AGPL-3.0-only](https://img.shields.io/badge/LICENSE_//_AGPL--3.0--only-3b5bdb?style=for-the-badge&labelColor=eff6ff)](https://www.gnu.org/licenses/agpl-3.0.html)


<br /><br />
> [!IMPORTANT]
> This SDK is not yet ready for production use. To complete setup please follow the steps outlined in your [workspace](https://app.speakeasy.com/org/mollie-oom/mollie). Delete this section before > publishing to a package manager.

<!-- Start Summary [summary] -->
## Summary


<!-- End Summary [summary] -->

<!-- Start Table of Contents [toc] -->
## Table of Contents
<!-- $toc-max-depth=2 -->
* [mollie/php](#molliephp)
  * [SDK Installation](#sdk-installation)
  * [SDK Example Usage](#sdk-example-usage)
  * [Authentication](#authentication)
  * [Available Resources and Operations](#available-resources-and-operations)
  * [Global Parameters](#global-parameters)
  * [Pagination](#pagination)
  * [Retries](#retries)
  * [Error Handling](#error-handling)
  * [Server Selection](#server-selection)
* [Development](#development)
  * [Maturity](#maturity)
  * [Contributions](#contributions)
* [mollie-automatic-api-php](#mollie-automatic-api-php)

<!-- End Table of Contents [toc] -->

<!-- Start SDK Installation [installation] -->
## SDK Installation

The SDK relies on [Composer](https://getcomposer.org/) to manage its dependencies.

To install the SDK and add it as a dependency to an existing `composer.json` file:
```bash
composer require "mollie/php"
```
<!-- End SDK Installation [installation] -->

<!-- Start SDK Example Usage [usage] -->
## SDK Example Usage

### Example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()->build();

$body = new Operations\OauthGenerateTokensRequestBody(
    grantType: Components\OauthGrantType::AuthorizationCode,
    code: 'auth_...',
    refreshToken: 'refresh_...',
    redirectUri: 'https://example.com/redirect',
);
$requestSecurity = new Operations\OauthGenerateTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->generate(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->object !== null) {
    // handle response
}
```
<!-- End SDK Example Usage [usage] -->

<!-- Start Authentication [security] -->
## Authentication

### Per-Client Security Schemes

This SDK supports the following security schemes globally:

| Name                  | Type   | Scheme       |
| --------------------- | ------ | ------------ |
| `apiKey`              | http   | HTTP Bearer  |
| `advancedAccessToken` | http   | HTTP Bearer  |
| `oAuth`               | oauth2 | OAuth2 token |

You can set the security parameters through the `setSecurity` function on the `SDKBuilder` when initializing the SDK. The selected scheme will be used by default to authenticate with the API for all operations that support it. For example:
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
    ->setTestmode(true)
    ->build();

$request = new Operations\ListBalancesRequest(
    currency: 'EUR',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->balances->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Per-Operation Security Schemes

Some operations in this SDK require the security scheme to be specified at the request level. For example:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()->build();

$body = new Operations\OauthGenerateTokensRequestBody(
    grantType: Components\OauthGrantType::AuthorizationCode,
    code: 'auth_...',
    refreshToken: 'refresh_...',
    redirectUri: 'https://example.com/redirect',
);
$requestSecurity = new Operations\OauthGenerateTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->generate(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->object !== null) {
    // handle response
}
```
<!-- End Authentication [security] -->

<!-- Start Available Resources and Operations [operations] -->
## Available Resources and Operations

<details open>
<summary>Available methods</summary>

### [Accounts](docs/sdks/accounts/README.md)

* [createAccount](docs/sdks/accounts/README.md#createaccount) - Create business account
* [listAccounts](docs/sdks/accounts/README.md#listaccounts) - List business accounts
* [getAccount](docs/sdks/accounts/README.md#getaccount) - Get business account
* [list](docs/sdks/accounts/README.md#list) - List transactions
* [get](docs/sdks/accounts/README.md#get) - Get transaction

### [BalanceTransfers](docs/sdks/balancetransfers/README.md)

* [create](docs/sdks/balancetransfers/README.md#create) - Create a Connect balance transfer
* [list](docs/sdks/balancetransfers/README.md#list) - List all Connect balance transfers
* [get](docs/sdks/balancetransfers/README.md#get) - Get a Connect balance transfer

### [Balances](docs/sdks/balances/README.md)

* [list](docs/sdks/balances/README.md#list) - List balances
* [get](docs/sdks/balances/README.md#get) - Get balance
* [getPrimary](docs/sdks/balances/README.md#getprimary) - Get primary balance
* [getReport](docs/sdks/balances/README.md#getreport) - Get balance report
* [listTransactions](docs/sdks/balances/README.md#listtransactions) - List balance transactions

### [Capabilities](docs/sdks/capabilities/README.md)

* [list](docs/sdks/capabilities/README.md#list) - List capabilities

### [Captures](docs/sdks/captures/README.md)

* [create](docs/sdks/captures/README.md#create) - Create capture
* [list](docs/sdks/captures/README.md#list) - List captures
* [get](docs/sdks/captures/README.md#get) - Get capture

### [Chargebacks](docs/sdks/chargebacks/README.md)

* [list](docs/sdks/chargebacks/README.md#list) - List payment chargebacks
* [get](docs/sdks/chargebacks/README.md#get) - Get payment chargeback
* [all](docs/sdks/chargebacks/README.md#all) - List all chargebacks

### [CheckoutSessions](docs/sdks/checkoutsessions/README.md)

* [create](docs/sdks/checkoutsessions/README.md#create) - Create Checkout Session
* [get](docs/sdks/checkoutsessions/README.md#get) - Get Checkout Session

### [ClientLinks](docs/sdks/clientlinks/README.md)

* [create](docs/sdks/clientlinks/README.md#create) - Create client link

### [Clients](docs/sdks/clients/README.md)

* [list](docs/sdks/clients/README.md#list) - List clients
* [get](docs/sdks/clients/README.md#get) - Get client

### [Customers](docs/sdks/customers/README.md)

* [create](docs/sdks/customers/README.md#create) - Create customer
* [list](docs/sdks/customers/README.md#list) - List customers
* [get](docs/sdks/customers/README.md#get) - Get customer
* [update](docs/sdks/customers/README.md#update) - Update customer
* [delete](docs/sdks/customers/README.md#delete) - Delete customer
* [createPayment](docs/sdks/customers/README.md#createpayment) - Create customer payment
* [listPayments](docs/sdks/customers/README.md#listpayments) - List customer payments

### [DelayedRouting](docs/sdks/delayedrouting/README.md)

* [create](docs/sdks/delayedrouting/README.md#create) - Create a delayed route
* [list](docs/sdks/delayedrouting/README.md#list) - List payment routes
* [get](docs/sdks/delayedrouting/README.md#get) - Get a delayed route

### [DraftTransfers](docs/sdks/drafttransfers/README.md)

* [create](docs/sdks/drafttransfers/README.md#create) - Create draft transfer
* [list](docs/sdks/drafttransfers/README.md#list) - List draft transfers
* [get](docs/sdks/drafttransfers/README.md#get) - Get draft transfer
* [cancel](docs/sdks/drafttransfers/README.md#cancel) - Cancel draft transfer

### [Invoices](docs/sdks/invoices/README.md)

* [list](docs/sdks/invoices/README.md#list) - List invoices
* [get](docs/sdks/invoices/README.md#get) - Get invoice

### [Mandates](docs/sdks/mandates/README.md)

* [create](docs/sdks/mandates/README.md#create) - Create mandate
* [list](docs/sdks/mandates/README.md#list) - List mandates
* [get](docs/sdks/mandates/README.md#get) - Get mandate
* [revoke](docs/sdks/mandates/README.md#revoke) - Revoke mandate

### [Methods](docs/sdks/methods/README.md)

* [list](docs/sdks/methods/README.md#list) - List payment methods
* [all](docs/sdks/methods/README.md#all) - List all payment methods
* [get](docs/sdks/methods/README.md#get) - Get payment method
* [enable](docs/sdks/methods/README.md#enable) - Enable payment method
* [disable](docs/sdks/methods/README.md#disable) - Disable payment method
* [enableIssuer](docs/sdks/methods/README.md#enableissuer) - Enable payment method issuer
* [disableIssuer](docs/sdks/methods/README.md#disableissuer) - Disable payment method issuer

### [Oauth](docs/sdks/oauth/README.md)

* [generate](docs/sdks/oauth/README.md#generate) - Generate tokens
* [revoke](docs/sdks/oauth/README.md#revoke) - Revoke tokens

### [Onboarding](docs/sdks/onboarding/README.md)

* [get](docs/sdks/onboarding/README.md#get) - Get onboarding status
* [submit](docs/sdks/onboarding/README.md#submit) - Submit onboarding data

### [Organizations](docs/sdks/organizations/README.md)

* [get](docs/sdks/organizations/README.md#get) - Get organization
* [getCurrent](docs/sdks/organizations/README.md#getcurrent) - Get current organization
* [getPartner](docs/sdks/organizations/README.md#getpartner) - Get partner status

### [PaymentLinks](docs/sdks/paymentlinks/README.md)

* [create](docs/sdks/paymentlinks/README.md#create) - Create payment link
* [list](docs/sdks/paymentlinks/README.md#list) - List payment links
* [get](docs/sdks/paymentlinks/README.md#get) - Get payment link
* [update](docs/sdks/paymentlinks/README.md#update) - Update payment link
* [delete](docs/sdks/paymentlinks/README.md#delete) - Delete payment link
* [listPayments](docs/sdks/paymentlinks/README.md#listpayments) - Get payment link payments

### [Payments](docs/sdks/payments/README.md)

* [create](docs/sdks/payments/README.md#create) - Create payment
* [list](docs/sdks/payments/README.md#list) - List payments
* [get](docs/sdks/payments/README.md#get) - Get payment
* [update](docs/sdks/payments/README.md#update) - Update payment
* [cancel](docs/sdks/payments/README.md#cancel) - Cancel payment
* [releaseAuthorization](docs/sdks/payments/README.md#releaseauthorization) - Release payment authorization

### [Payouts](docs/sdks/payouts/README.md)

* [create](docs/sdks/payouts/README.md#create) - Create payout
* [list](docs/sdks/payouts/README.md#list) - List payouts
* [get](docs/sdks/payouts/README.md#get) - Get payout
* [cancel](docs/sdks/payouts/README.md#cancel) - Cancel payout

### [Permissions](docs/sdks/permissions/README.md)

* [list](docs/sdks/permissions/README.md#list) - List permissions
* [get](docs/sdks/permissions/README.md#get) - Get permission

### [Profiles](docs/sdks/profiles/README.md)

* [create](docs/sdks/profiles/README.md#create) - Create profile
* [list](docs/sdks/profiles/README.md#list) - List profiles
* [get](docs/sdks/profiles/README.md#get) - Get profile
* [update](docs/sdks/profiles/README.md#update) - Update profile
* [delete](docs/sdks/profiles/README.md#delete) - Delete profile
* [getCurrent](docs/sdks/profiles/README.md#getcurrent) - Get current profile

### [Refunds](docs/sdks/refunds/README.md)

* [create](docs/sdks/refunds/README.md#create) - Create payment refund
* [list](docs/sdks/refunds/README.md#list) - List payment refunds
* [get](docs/sdks/refunds/README.md#get) - Get payment refund
* [cancel](docs/sdks/refunds/README.md#cancel) - Cancel payment refund
* [all](docs/sdks/refunds/README.md#all) - List all refunds

### [Reports](docs/sdks/reports/README.md)

* [create](docs/sdks/reports/README.md#create) - Create report
* [get](docs/sdks/reports/README.md#get) - Get report

### [SalesInvoices](docs/sdks/salesinvoices/README.md)

* [create](docs/sdks/salesinvoices/README.md#create) - Create sales invoice
* [list](docs/sdks/salesinvoices/README.md#list) - List sales invoices
* [get](docs/sdks/salesinvoices/README.md#get) - Get sales invoice
* [update](docs/sdks/salesinvoices/README.md#update) - Update sales invoice
* [delete](docs/sdks/salesinvoices/README.md#delete) - Delete sales invoice

### [Settlements](docs/sdks/settlements/README.md)

* [list](docs/sdks/settlements/README.md#list) - List settlements
* [get](docs/sdks/settlements/README.md#get) - Get settlement
* [getOpen](docs/sdks/settlements/README.md#getopen) - Get open settlement
* [getNext](docs/sdks/settlements/README.md#getnext) - Get next settlement
* [listPayments](docs/sdks/settlements/README.md#listpayments) - List settlement payments
* [listCaptures](docs/sdks/settlements/README.md#listcaptures) - List settlement captures
* [listRefunds](docs/sdks/settlements/README.md#listrefunds) - List settlement refunds
* [listChargebacks](docs/sdks/settlements/README.md#listchargebacks) - List settlement chargebacks

### [Subscriptions](docs/sdks/subscriptions/README.md)

* [create](docs/sdks/subscriptions/README.md#create) - Create subscription
* [list](docs/sdks/subscriptions/README.md#list) - List customer subscriptions
* [get](docs/sdks/subscriptions/README.md#get) - Get subscription
* [update](docs/sdks/subscriptions/README.md#update) - Update subscription
* [cancel](docs/sdks/subscriptions/README.md#cancel) - Cancel subscription
* [all](docs/sdks/subscriptions/README.md#all) - List all subscriptions
* [listPayments](docs/sdks/subscriptions/README.md#listpayments) - List subscription payments

### [Terminals](docs/sdks/terminals/README.md)

* [list](docs/sdks/terminals/README.md#list) - List terminals
* [get](docs/sdks/terminals/README.md#get) - Get terminal
* [terminalsRequestPairingCode](docs/sdks/terminals/README.md#terminalsrequestpairingcode) - Request terminal pairing code
* [terminalsListPairingCodes](docs/sdks/terminals/README.md#terminalslistpairingcodes) - List terminal pairing codes
* [terminalsGetPairingCode](docs/sdks/terminals/README.md#terminalsgetpairingcode) - Get terminal pairing code
* [terminalsRevokePairingCode](docs/sdks/terminals/README.md#terminalsrevokepairingcode) - Revoke terminal pairing code

### [Transfers](docs/sdks/transfers/README.md)

* [create](docs/sdks/transfers/README.md#create) - Create transfer
* [get](docs/sdks/transfers/README.md#get) - Get transfer

### [UnmatchedCreditTransfers](docs/sdks/unmatchedcredittransfers/README.md)

* [list](docs/sdks/unmatchedcredittransfers/README.md#list) - List unmatched credit transfers
* [get](docs/sdks/unmatchedcredittransfers/README.md#get) - Get unmatched credit transfer
* [match](docs/sdks/unmatchedcredittransfers/README.md#match) - Match unmatched credit transfer
* [return](docs/sdks/unmatchedcredittransfers/README.md#return) - Return unmatched credit transfer

### [VerifyPayee](docs/sdks/verifypayee/README.md)

* [create](docs/sdks/verifypayee/README.md#create) - Verify Payee

### [Wallets](docs/sdks/wallets/README.md)

* [requestApplePaySession](docs/sdks/wallets/README.md#requestapplepaysession) - Request Apple Pay payment session

### [WebhookEvents](docs/sdks/webhookevents/README.md)

* [get](docs/sdks/webhookevents/README.md#get) - Get a Webhook Event

### [Webhooks](docs/sdks/webhooks/README.md)

* [create](docs/sdks/webhooks/README.md#create) - Create a webhook
* [list](docs/sdks/webhooks/README.md#list) - List all webhooks
* [update](docs/sdks/webhooks/README.md#update) - Update a webhook
* [get](docs/sdks/webhooks/README.md#get) - Get a webhook
* [delete](docs/sdks/webhooks/README.md#delete) - Delete a webhook
* [test](docs/sdks/webhooks/README.md#test) - Test a webhook

</details>
<!-- End Available Resources and Operations [operations] -->

<!-- Start Global Parameters [global-parameters] -->
## Global Parameters

Certain parameters are configured globally. These parameters may be set on the SDK client instance itself during initialization. When configured as an option during SDK initialization, These global values will be used as defaults on the operations that use them. When such operations are called, there is a place in each to override the global value, if needed.

For example, you can set `profileId` to `` at SDK initialization and then you do not have to pass the same value on calls to operations like `list`. But if you want to do so you may, which will locally override the global setting. See the example code below for a demonstration.


### Available Globals

The following global parameters are available.

| Name            | Type   | Description                                                                                                                                                                                                                                                                                                                                                                                              |
| --------------- | ------ | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| profileId       | string | The identifier referring to the [profile](get-profile) you wish to<br/>retrieve the resources for.<br/><br/>Most API credentials are linked to a single profile. In these cases the `profileId` must not be sent. For<br/>organization-level credentials such as OAuth access tokens however, the `profileId` parameter is required.                                                                     |
| testmode        | bool   | Most API credentials are specifically created for either live mode or test mode. In those cases the `testmode` query<br/>parameter must not be sent. For organization-level credentials such as OAuth access tokens, you can enable test mode by<br/>setting the `testmode` query parameter to `true`.<br/><br/>Test entities cannot be retrieved when the endpoint is set to live mode, and vice versa. |
| customUserAgent | string | Custom user agent string to be appended to the default Mollie SDK user agent.                                                                                                                                                                                                                                                                                                                            |

### Example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setTestmode(true)
    ->setProfileId('<id>')
    ->setCustomUserAgent('<value>')
    ->setSecurity(
        new Components\Security(
            advancedAccessToken: '<YOUR_BEARER_TOKEN_HERE>',
        )
    )
    ->build();

$request = new Operations\ListBalancesRequest(
    currency: 'EUR',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->balances->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
<!-- End Global Parameters [global-parameters] -->

<!-- Start Pagination [pagination] -->
## Pagination

Some of the endpoints in this SDK support pagination. To use pagination, you make your SDK calls as usual, but the
returned object will be a `Generator` instead of an individual response.

Working with generators is as simple as iterating over the responses in a `foreach` loop, and you can see an example below:
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

$request = new Operations\ListBalancesRequest(
    currency: 'EUR',
    limit: 50,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    xClientSignature: 'MEUCIQDx8sJvK3z...',
    xClientSignedAt: '2025-01-01T12:00:00Z',
);

$responses = $sdk->balances->list(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
<!-- End Pagination [pagination] -->

<!-- Start Retries [retries] -->
## Retries

Some of the endpoints in this SDK support retries. If you use the SDK without any configuration, it will fall back to the default retry strategy provided by the API. However, the default retry strategy can be overridden on a per-operation basis, or across the entire SDK.

To change the default retry strategy for a single API call, simply provide an `Options` object built with a `RetryConfig` object to the call:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;
use Mollie\Api\Utils\Retry;

$sdk = Api\Client::builder()->build();

$body = new Operations\OauthGenerateTokensRequestBody(
    grantType: Components\OauthGrantType::AuthorizationCode,
    code: 'auth_...',
    refreshToken: 'refresh_...',
    redirectUri: 'https://example.com/redirect',
);
$requestSecurity = new Operations\OauthGenerateTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->generate(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body,
    options: Utils\Options->builder()->setRetryConfig(
        new Retry\RetryConfigBackoff(
            initialInterval: 1,
            maxInterval:     50,
            exponent:        1.1,
            maxElapsedTime:  100,
            retryConnectionErrors: false,
        ))->build()

);

if ($response->object !== null) {
    // handle response
}
```

If you'd like to override the default retry strategy for all operations that support retries, you can pass a `RetryConfig` object to the `SDKBuilder->setRetryConfig` function when initializing the SDK:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;
use Mollie\Api\Utils\Retry;

$sdk = Api\Client::builder()
    ->setRetryConfig(
        new Retry\RetryConfigBackoff(
            initialInterval: 1,
            maxInterval:     50,
            exponent:        1.1,
            maxElapsedTime:  100,
            retryConnectionErrors: false,
        )
  )
    ->build();

$body = new Operations\OauthGenerateTokensRequestBody(
    grantType: Components\OauthGrantType::AuthorizationCode,
    code: 'auth_...',
    refreshToken: 'refresh_...',
    redirectUri: 'https://example.com/redirect',
);
$requestSecurity = new Operations\OauthGenerateTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->generate(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->object !== null) {
    // handle response
}
```
<!-- End Retries [retries] -->

<!-- Start Error Handling [errors] -->
## Error Handling

Handling errors in this SDK should largely match your expectations. All operations return a response object or throw an exception.

By default an API error will raise a `Errors\APIException` exception, which has the following properties:

| Property       | Type                                    | Description           |
|----------------|-----------------------------------------|-----------------------|
| `$message`     | *string*                                | The error message     |
| `$statusCode`  | *int*                                   | The HTTP status code  |
| `$rawResponse` | *?\Psr\Http\Message\ResponseInterface*  | The raw HTTP response |
| `$body`        | *string*                                | The response content  |

When custom error responses are specified for an operation, the SDK may also throw their associated exception. You can refer to respective *Errors* tables in SDK docs for more details on possible exception types for each operation. For example, the `generate` method throws the following exceptions:

| Error Type           | Status Code | Content Type         |
| -------------------- | ----------- | -------------------- |
| Errors\ErrorResponse | 429         | application/hal+json |
| Errors\APIException  | 4XX, 5XX    | \*/\*                |

### Example

```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Errors;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()->build();

try {
    $body = new Operations\OauthGenerateTokensRequestBody(
        grantType: Components\OauthGrantType::AuthorizationCode,
        code: 'auth_...',
        refreshToken: 'refresh_...',
        redirectUri: 'https://example.com/redirect',
    );
    $requestSecurity = new Operations\OauthGenerateTokensSecurity(
        username: '',
        password: '',
    );

    $response = $sdk->oauth->generate(
        security: $requestSecurity,
        idempotencyKey: '123e4567-e89b-12d3-a456-426',
        body: $body

    );

    if ($response->object !== null) {
        // handle response
    }
} catch (Errors\ErrorResponseThrowable $e) {
    // handle $e->$container data
    throw $e;
} catch (Errors\APIException $e) {
    // handle default exception
    throw $e;
}
```
<!-- End Error Handling [errors] -->

<!-- Start Server Selection [server] -->
## Server Selection

### Override Server URL Per-Client

The default server can be overridden globally using the `setServerUrl(string $serverUrl)` builder method when initializing the SDK client instance. For example:
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()
    ->setServerURL('https://api.mollie.com')
    ->build();

$body = new Operations\OauthGenerateTokensRequestBody(
    grantType: Components\OauthGrantType::AuthorizationCode,
    code: 'auth_...',
    refreshToken: 'refresh_...',
    redirectUri: 'https://example.com/redirect',
);
$requestSecurity = new Operations\OauthGenerateTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->generate(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->object !== null) {
    // handle response
}
```
<!-- End Server Selection [server] -->

<!-- Placeholder for Future Speakeasy SDK Sections -->

# Development

## Maturity

This SDK is in alpha, and there may be breaking changes between versions without a major version update. Therefore, we recommend pinning usage
to a specific package version. This way, you can install the same version each time without breaking changes unless you are intentionally
looking for the latest version.

## Contributions

While we value open-source contributions to this SDK, this library is generated programmatically. Any manual changes added to internal files will be overwritten on the next generation. 
We look forward to hearing your feedback. Feel free to open a PR or an issue with a proof of concept and we'll do our best to include it in a future release. 

### SDK Created by [Speakeasy](https://www.speakeasy.com/?utm_source=mollie/php&utm_campaign=php)
# mollie-automatic-api-php
