# Oauth

## Overview

### Available Operations

* [generate](#generate) - Generate tokens
* [revoke](#revoke) - Revoke tokens

## generate

Exchange the authorization code you received from the [Authorize endpoint](oauth-authorize) for an 'access token'
API credential, with which you can communicate with the Mollie API on behalf of the consenting merchant.

This endpoint can only be accessed using **OAuth client credentials**.

### Example Usage

<!-- UsageSnippet language="php" operationID="oauth-generate-tokens" method="post" path="/oauth2/tokens" example="oauth-generate-tokens" -->
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

### Parameters

| Parameter                                                                                               | Type                                                                                                    | Required                                                                                                | Description                                                                                             | Example                                                                                                 |
| ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------- |
| `security`                                                                                              | [Operations\OauthGenerateTokensSecurity](../../Models/Operations/OauthGenerateTokensSecurity.md)        | :heavy_check_mark:                                                                                      | The security requirements to use for the request.                                                       |                                                                                                         |
| `idempotencyKey`                                                                                        | *?string*                                                                                               | :heavy_minus_sign:                                                                                      | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                        | 123e4567-e89b-12d3-a456-426                                                                             |
| `body`                                                                                                  | [?Operations\OauthGenerateTokensRequestBody](../../Models/Operations/OauthGenerateTokensRequestBody.md) | :heavy_minus_sign:                                                                                      | N/A                                                                                                     |                                                                                                         |

### Response

**[?Operations\OauthGenerateTokensResponse](../../Models/Operations/OauthGenerateTokensResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |

## revoke

Revoke an access token or refresh token. Once revoked, the token can no longer be used.

Revoking a refresh token revokes all access tokens that were created using the same authorization.

This endpoint can only be accessed using **OAuth client credentials**.

### Example Usage

<!-- UsageSnippet language="php" operationID="oauth-revoke-tokens" method="delete" path="/oauth2/tokens" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use Mollie\Api;
use Mollie\Api\Models\Components;
use Mollie\Api\Models\Operations;

$sdk = Api\Client::builder()->build();

$body = new Operations\OauthRevokeTokensRequestBody(
    tokenTypeHint: Components\OauthTokenTypeHint::AccessToken,
    token: 'access_...',
);
$requestSecurity = new Operations\OauthRevokeTokensSecurity(
    username: '',
    password: '',
);

$response = $sdk->oauth->revoke(
    security: $requestSecurity,
    idempotencyKey: '123e4567-e89b-12d3-a456-426',
    body: $body

);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                           | Type                                                                                                | Required                                                                                            | Description                                                                                         | Example                                                                                             |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| `security`                                                                                          | [Operations\OauthRevokeTokensSecurity](../../Models/Operations/OauthRevokeTokensSecurity.md)        | :heavy_check_mark:                                                                                  | The security requirements to use for the request.                                                   |                                                                                                     |
| `idempotencyKey`                                                                                    | *?string*                                                                                           | :heavy_minus_sign:                                                                                  | A unique key to ensure idempotent requests. This key should be a UUID v4 string.                    | 123e4567-e89b-12d3-a456-426                                                                         |
| `body`                                                                                              | [?Operations\OauthRevokeTokensRequestBody](../../Models/Operations/OauthRevokeTokensRequestBody.md) | :heavy_minus_sign:                                                                                  | N/A                                                                                                 |                                                                                                     |

### Response

**[?Operations\OauthRevokeTokensResponse](../../Models/Operations/OauthRevokeTokensResponse.md)**

### Errors

| Error Type           | Status Code          | Content Type         |
| -------------------- | -------------------- | -------------------- |
| Errors\ErrorResponse | 429                  | application/hal+json |
| Errors\APIException  | 4XX, 5XX             | \*/\*                |