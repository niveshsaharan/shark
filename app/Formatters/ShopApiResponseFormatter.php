<?php

namespace App\Formatters;

use Illuminate\Support\Arr;
use Osiset\BasicShopifyAPI\ResponseAccess;

/**
 * Class Shop
 *
 * @package \App\Formatters
 */
class ShopApiResponseFormatter
{
    public function format(ResponseAccess $data): ? array
    {
        $data = (array) $data->container;

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
            'shopify_gid' => 'id',
            'domain' => 'primaryDomain.host',
            'shop_name' => 'name',
            'contact_email' => 'contactEmail',
            'city' => 'billingAddress.city',
            'province' => 'billingAddress.province',
            'province_code' => 'billingAddress.provinceCode',
            'country' => 'billingAddress.country',
            'country_code' => 'billingAddress.countryCodeV2',
            'currency' => 'currencyCode',
            'presentment_currencies' => 'enabledPresentmentCurrencies',
            'money_format' => 'currencyFormats.moneyFormat',
            'money_with_currency_format' => 'currencyFormats.moneyWithCurrencyFormat',
            'money_in_email_format' => 'currencyFormats.moneyInEmailsFormat',
            'money_with_currency_in_email_format' => 'currencyFormats.moneyWithCurrencyInEmailsFormat',
            'timezone_offset' => 'timezoneOffset',
            'iana_timezone' => 'ianaTimezone',
            'shopify_plan_display_name' => 'plan.displayName',
            'shopify_partner' => 'plan.partnerDevelopment',
            'shopify_plus' => 'plan.shopifyPlus',
        ];
    }
}
