<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$model = Config::get('auth.providers.users.model');

$factory->define($model, function (Faker $faker) {
    return [
        'name'     => "{$faker->domainWord}",
        'password' => str_replace('-', '', $faker->uuid),
        'shopify_domain'     => "{$faker->domainWord}.myshopify.com",
        'shopify_token' => str_replace('-', '', $faker->uuid),
        'email'    => $faker->email,
    ];
});

$factory->state($model, 'freemium', [
    'shopify_freemium' => true,
]);

$factory->state($model, 'grandfathered', [
    'shopify_grandfathered' => true,
]);
