<?php

namespace Tests\Feature\Jobs;

use App\Jobs\FetchAndUpdateShopJob;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\Stubs\Api as ApiStub;
use Tests\TestCase;

class FetchAndUpdateShopTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_fetches_result_from_graphql_api_and_saves_to_database()
    {
        // Create a shop
        $shop = factory(User::class)->create();

        // Setup API stub
        $this->setApiStub();
        ApiStub::stubResponses(['shop']);

        $expected = [
            'shopify_gid' => 'gid://shopify/Shop/6587023382',
            'domain' => 'graphql-admin.myshopify.com',
            'shop_name' => 'graphql-admin',
            'contact_email' => 'shayne@shopify.com',
            'city' => 'Test City',
            'province' => 'Ontario',
            'province_code' => 'ON',
            'country' => 'Canada',
            'country_code' => 'CA',
            'currency' => 'CAD',
            'presentment_currencies' => [
                'CAD',
            ],
            'money_format' => '${{amount}}',
            'money_with_currency_format' => '${{amount}} CAD',
            'money_in_email_format' => '${{amount}}',
            'money_with_currency_in_email_format' => '${{amount}} CAD',
            'timezone_offset' => '-0400',
            'iana_timezone' => 'America/Toronto',
            'shopify_plan_display_name' => 'staff',
            'shopify_partner' => false,
            'shopify_plus' => false,
        ];

        foreach (Arr::only($expected, [
            'shopify_gid',
            'domain',
            'shop_name',
            'contact_email',
        ]) as $column => $value) {
            $this->assertNotSame($shop->$column, $value);
        }

        // Run the job
        $response = FetchAndUpdateShopJob::dispatchNow(
            $shop
        );

        $this->assertSame($response, 1);

        // Refresh both models to see the changes
        $shop->refresh();

        foreach ($expected as $column => $value) {
            $this->assertSame($shop->$column, $value);
        }
    }
}
