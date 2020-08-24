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
];
