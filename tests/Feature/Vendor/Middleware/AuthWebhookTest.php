<?php

namespace Tests\Feature\Vendor\Middleware;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;
use Osiset\ShopifyApp\Http\Middleware\AuthWebhook as AuthWebhookMiddleware;
use Tests\TestCase;

class AuthWebhookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function uses_correct_api_secret_for_public_app()
    {
        $secret = md5(rand(1, 100));

        config()->set('shopify-app.api_secret', $secret);

        $currentRequest = Request::instance();
        $newRequest = $currentRequest->duplicate(
        // Query Params
            [],
            // Request Params
            null,
            // Attributes
            null,
            // Cookies
            null,
            // Files
            null,
            // Server vars
            // This valid referer should be ignored as there is a get variable
            array_merge(Request::server(), [
                'HTTP_X_Shopify_Hmac_Sha256' => base64_encode(hash_hmac('sha256', '',  $secret, true)),
                'HTTP_X_Shopify_Shop_Domain' => 'example.myshopify.com',
            ])
        );
        Request::swap($newRequest);

        // Run the middleware
        $called = false;
        $response = ($this->app->make(AuthWebhookMiddleware::class))->handle(request(), function () use (&$called) {
            $called = true;
        });

        // Assert we get a proper response
        $this->assertTrue($called);
    }

    /**
     * @test
     */
    public function uses_correct_api_secret_for_private_app()
    {
        $secret = md5(rand(1, 100));

        factory(User::class)->create([
            'name' => 'example.myshopify.com',
            'api_type' => 'private',
            'api_key' => 'key',
            'api_secret' => $secret,
            'api_password' => 'password',
        ]);

        $currentRequest = Request::instance();
        $newRequest = $currentRequest->duplicate(
        // Query Params
            [],
            // Request Params
            null,
            // Attributes
            null,
            // Cookies
            null,
            // Files
            null,
            // Server vars
            // This valid referer should be ignored as there is a get variable
            array_merge(Request::server(), [
                'HTTP_X_Shopify_Hmac_Sha256' => base64_encode(hash_hmac('sha256', '',  $secret, true)),
                'HTTP_X_Shopify_Shop_Domain' => 'example.myshopify.com',
            ])
        );
        Request::swap($newRequest);

        // Run the middleware
        $called = false;
        $response = ($this->app->make(AuthWebhookMiddleware::class))->handle(request(), function () use (&$called) {
            $called = true;
        });

        // Assert we get a proper response
        $this->assertTrue($called);
    }

    /**
     * @test
     */
    public function uses_correct_api_secret_for_custom_app()
    {
        $secret = md5(rand(1, 100));

        factory(User::class)->create([
            'name' => 'example.myshopify.com',
            'api_type' => 'custom',
            'api_key' => 'key',
            'api_secret' => $secret,
        ]);

        $currentRequest = Request::instance();
        $newRequest = $currentRequest->duplicate(
        // Query Params
            [],
            // Request Params
            null,
            // Attributes
            null,
            // Cookies
            null,
            // Files
            null,
            // Server vars
            // This valid referer should be ignored as there is a get variable
            array_merge(Request::server(), [
                'HTTP_X_Shopify_Hmac_Sha256' => base64_encode(hash_hmac('sha256', '',  $secret, true)),
                'HTTP_X_Shopify_Shop_Domain' => 'example.myshopify.com',
            ])
        );
        Request::swap($newRequest);

        // Run the middleware
        $called = false;
        $response = ($this->app->make(AuthWebhookMiddleware::class))->handle(request(), function () use (&$called) {
            $called = true;
        });

        // Assert we get a proper response
        $this->assertTrue($called);
    }
}
