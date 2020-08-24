<?php

namespace App\Formatters;

use Illuminate\Support\Arr;

/**
 * Class Shop
 *
 * @package \App\Formatters
 */
class ShopWebhookResponseFormatter
{
    public function format(\stdClass $data): ? array
    {
        $data = (array) $data;

        return collect($this->rules())
            ->filter(function ($value, $key) use ($data) {
                return Arr::has($data, $value);
            })
            ->mapWithKeys(function ($value, $key) use ($data) {
                return [$key => Arr::get($data, $value)];
            })
            ->toArray();
    }

    public function rules(): array
    {
        return [
            'domain' => 'domain',
            'shop_name' => 'name',
            'contact_email' => 'customer_email',
            'city' => 'city',
            'province' => 'province',
            'province_code' => 'province_code',
            'country' => 'country_name',
            'country_code' => 'country_code',
            'currency' => 'currency',
            'presentment_currencies' => 'enabled_presentment_currencies',
            'money_format' => 'money_format',
            'money_with_currency_format' => 'money_with_currency_format',
            'money_in_email_format' => 'money_in_emails_format',
            'money_with_currency_in_email_format' => 'money_with_currency_in_emails_format',
            'iana_timezone' => 'iana_timezone',
            'shopify_plan_display_name' => 'plan_display_name',
        ];
    }
}
