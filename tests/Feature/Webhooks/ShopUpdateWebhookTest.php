<?php

namespace Tests\Feature\Webhooks;

use App\Models\User;
use App\Webhooks\ShopUpdateWebhook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ShopUpdateWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_updates_shop_with_webhook_data()
    {
        // Create a shop
        $shop = User::factory()->create([
            'shopify_domain' => 'apple.myshopify.com',
        ]);

        $expected = [
            'domain' => 'shop.apple.com',
            'shop_name' => 'Apple Computers',
            'shop_email' => 'steve@apple.com',
            'contact_email' => 'customers@apple.com',
            'city' => 'Cupertino',
            'province' => 'California',
            'province_code' => 'CA',
            'country' => 'United States',
            'country_code' => 'US',
            'currency' => 'USD',
            'presentment_currencies' => [
                'USD',
            ],
            'money_format' => '${{amount}}',
            'money_with_currency_format' => '${{amount}} USD',
            'money_in_email_format' => '${{amount}}',
            'money_with_currency_in_email_format' => '${{amount}} USD',
            'iana_timezone' => 'America/New_York',
            'shopify_plan_display_name' => 'Shopify Plus',
        ];

        foreach (Arr::only($expected, [
            'domain',
            'shop_name',
            'contact_email',
        ]) as $column => $value) {
            $this->assertNotSame($shop->$column, $value);
        }

        // Run the job
        $response = ShopUpdateWebhook::dispatchNow(
            $shop->getDomain(),
            json_decode(file_get_contents($this->fixturesPath.'/webhooks/shop__update.json'))
        );

        $this->assertSame($response, 1);

        // Refresh both models to see the changes
        $shop->refresh();

        foreach ($expected as $column => $value) {
            $this->assertSame($shop->$column, $value);
        }
    }
}
