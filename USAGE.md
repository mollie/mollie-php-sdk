<!-- Start SDK Example Usage [usage] -->
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