<?php

namespace Tests\Feature\Webhooks;

use App\Models\User;
use App\Webhooks\CustomersRedactWebhook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use Tests\TestCase;

class CustomersRedactWebhookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_receives_data_and_returns_true()
    {
        // Create a shop
        $shop = User::factory()->create([
            'shopify_domain' => 'apple.myshopify.com',
        ]);

        // Run the job
        $response = CustomersRedactWebhook::dispatchNow(
            ShopDomain::fromNative($shop->name),
            json_decode(file_get_contents($this->fixturesPath.'/webhooks/customers__redact.json'))
        );

        $this->assertTrue($response);
    }
}
