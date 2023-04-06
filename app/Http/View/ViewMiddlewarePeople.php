<?php

namespace Tests\Unit\Formatters;

use App\Formatters\ShopApiResponseFormatter;
use Osiset\BasicShopifyAPI\ResponseAccess;
use PHPUnit\Framework\TestCase;

class ShopApiResponseFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_format_api_response_correctly()
    {
        $input = new ResponseAccess(json_decode(file_get_contents(__DIR__.'/../../fixtures/graphql/shop.json'), true)['data']['shop']);

        $expected = [
            'shopify_gid' => 'gid://shopify/Shop/6587023382',
            'domain' => 'graphql-admin.myshopify.com',
            'shop_name' => 'graphql-admin',
            'shop_email' => 'shayne@shopify.com',
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

        sort($expected);

        $output = resolve(ShopApiResponseFormatter::class)->format($input);
        sort($output);

        $this->assertSame($expected, $output);
    }
}
