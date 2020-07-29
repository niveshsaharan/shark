<?php

namespace Tests\Unit\Formatters;

use App\Formatters\ShopWebhookResponseFormatter;
use Tests\TestCase;

class ShopWebhookResponseFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_format_webhook_response_correctly()
    {
        $input = json_decode(file_get_contents($this->fixturesPath.'/webhooks/shop__update.json'));

        $expected = [
            'domain' => 'shop.apple.com',
            'shop_name' => 'Apple Computers',
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

        sort($expected);

        $output = resolve(ShopWebhookResponseFormatter::class)->format($input);
        sort($output);

        $this->assertSame($expected, $output);
    }
}
