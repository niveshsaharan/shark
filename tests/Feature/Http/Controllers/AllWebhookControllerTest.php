<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\WebhookController;
use App\Models\User;
use App\Webhooks\ShopUpdateWebhook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class WebhookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('shopify-app.api_secret', 'hush');
    }

    /**
     * @test
     */
    public function it_uses_correct_middlewares()
    {
        $this->assertActionUsesMiddleware(WebhookController::class, '__invoke', ['web', 'auth.webhook']);
    }

    /**
     * @test
     */
    public function it_can_catch_valid_type_webhook(): void
    {
        // createHmac(['data' => $data, 'raw' => true, 'encode' => true], 'hush');

        // Fake the queue
        Queue::fake();

        // Mock headers that match Shopify
        $shop = User::factory()->create(['shopify_domain' => 'apple.myshopify.com']);

        $headers = [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_X_SHOPIFY_SHOP_DOMAIN' => $shop->shopify_domain,
            'HTTP_X_SHOPIFY_HMAC_SHA256' => '+TsCekZg2nrlucyWVBp9C6v/zrvYm8DEVD72PIulnak=', // Matches fixture data and API secret
        ];

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook/shop-update',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        // Check it was created and job was pushed
        $response->assertStatus(201);

        Queue::assertPushed(ShopUpdateWebhook::class, function ($job) use ($shop) {
            return $job->shopDomain->isSame($shop->getDomain())
                && $job->data instanceof \stdClass
                && $job->data->email === 'steve@apple.com'
                && $job->data->myshopify_domain === 'apple.myshopify.com';
        });
    }

    /**
     * @test
     */
    public function it_can_catch_valid_topic_webhook(): void
    {
        // createHmac(['data' => $data, 'raw' => true, 'encode' => true], 'hush');

        // Fake the queue
        Queue::fake();

        // Mock headers that match Shopify
        $shop = User::factory()->create(['shopify_domain' => 'apple.myshopify.com']);

        $headers = [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_X_SHOPIFY_SHOP_DOMAIN' => $shop->shopify_domain,
            'HTTP_X_SHOPIFY_HMAC_SHA256' => '+TsCekZg2nrlucyWVBp9C6v/zrvYm8DEVD72PIulnak=', // Matches fixture data and API secret
        ];

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook?topic=shop/update',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        // Check it was created and job was pushed
        $response->assertStatus(201);

        Queue::assertPushed(ShopUpdateWebhook::class, function ($job) use ($shop) {
            return $job->shopDomain->isSame($shop->getDomain())
                && $job->data instanceof \stdClass
                && $job->data->email === 'steve@apple.com'
                && $job->data->myshopify_domain === 'apple.myshopify.com';
        });
    }

    /**
     * @test
     */
    public function it_throws_403_if_topic_is_not_supplied(): void
    {
        // Mock headers that match Shopify
        $shop = User::factory()->create(['shopify_domain' => 'apple.myshopify.com']);

        $headers = [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_X_SHOPIFY_SHOP_DOMAIN' => $shop->shopify_domain,
            'HTTP_X_SHOPIFY_HMAC_SHA256' => '+TsCekZg2nrlucyWVBp9C6v/zrvYm8DEVD72PIulnak=', // Matches fixture data and API secret
        ];

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(403);

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function it_throws_404_if_webhook_job_does_not_exists(): void
    {
        // Mock headers that match Shopify
        $shop = User::factory()->create(['shopify_domain' => 'apple.myshopify.com']);

        $headers = [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_X_SHOPIFY_SHOP_DOMAIN' => $shop->shopify_domain,
            'HTTP_X_SHOPIFY_HMAC_SHA256' => '+TsCekZg2nrlucyWVBp9C6v/zrvYm8DEVD72PIulnak=', // Matches fixture data and API secret
        ];

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook?topic=shop/some-invalid-topic',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(404);

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook/shop-some-invalid-topic',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function it_throws_401_if_headers_are_not_valid(): void
    {
        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook/shop-update',
            [],
            [],
            [],
            [],
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(401);

        $headers = [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_X_SHOPIFY_SHOP_DOMAIN' => 'my-shop.myshopify.com',
            'HTTP_X_SHOPIFY_HMAC_SHA256' => 'yGbDMKfotIqKG8CebV020BTJWtY/H/7w9Lemf66Mj7k=', // Matches fixture data and API secret
        ];

        // Create a webhook call and pass in our own headers and data
        $response = $this->call(
            'post',
            '/webhook/shop-update',
            [],
            [],
            [],
            $headers,
            file_get_contents($this->fixturesPath.'/webhooks/shop__update.json')
        );

        $response->assertStatus(401);
    }
}
