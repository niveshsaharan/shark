<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shopify Affiliate URL
    |--------------------------------------------------------------------------
    |
    | This option simply lets you set the URL where you want people to go when
    | they click Learn more about Shopify
    |
    */

    'shopify_affiliate_url' => env('SHOPIFY_AFFILIATE_URL', 'https://shopify.com'),

    /*
    |--------------------------------------------------------------------------
    | Shopify App Slug
    |--------------------------------------------------------------------------
    |
    | This option simply lets you define app's slug
    |
    */

    'app_slug' => env('SHOPIFY_APP_SLUG'),

    /*
    |--------------------------------------------------------------------------
    | Shopify App description
    |--------------------------------------------------------------------------
    |
    | Simple 2-3 line description to show on login page
    |
    */

    'app_description' => env('SHARK_APP_DESCRIPTION', 'Simple Shopify app that help you make your store more attractive.'),

    /*
    |--------------------------------------------------------------------------
    | Shopify App demo URL
    |--------------------------------------------------------------------------
    |
    | A URL where people see a demo of the working app
    |
    */
    'demo_url' => env('SHARK_DEMO_URL'),

    /*
    |--------------------------------------------------------------------------
    | Test Shops
    |--------------------------------------------------------------------------
    |
    | Shops having their myshopify.com domain in the following list will be able to
    | use the app without real charge
    */
    'tester_shops' => array_filter(explode(',', env('SHOPIFY_TESTER_SHOPS'))),

    /*
    |--------------------------------------------------------------------------
    | Test Plans
    |--------------------------------------------------------------------------
    |
    | The shops on one of these plans will be able to use the app without any real charge.
    | It is helpful when you want to allow shopify partners to test and use the app free of charge
    */
    'tester_plans' => array_filter(explode(',', env('SHOPIFY_TESTER_PLANS'))),

    /*
    |--------------------------------------------------------------------------
    | Shopify Partner as Tester
    |--------------------------------------------------------------------------
    |
    | If this is set to true, Shopify partners will be able to use the app without any real charge.
    | It is helpful when you want to allow shopify partners to test and use the app free of charge
    */
    'shopify_partner_as_tester' => env('SHOPIFY_PARTNER_AS_TESTER_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | FAQs
    |--------------------------------------------------------------------------
    |
    | Set a full URL to FAQs of your app
    */
    'faq_url' => env('SHOPIFY_FAQ_URL'),
];
