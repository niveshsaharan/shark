<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'shopify_domain' => $faker->unique()->domainWord.'.myshopify.com',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'shopify_token' => $faker->password,
        'remember_token' => Str::random(10),
        'shopify_grandfathered' => false,
        'shopify_freemium' => false,
        'shopify_gid' => 'gid://shopify/Shop/'.$faker->unique()->numberBetween(1000000000, 9999999999),
        'domain' => $faker->domainName,
        'shop_name' => $faker->name,
        'contact_email' => $faker->email,
        'city' => $faker->city,
        'province' => $faker->state,
        'province_code' => substr($faker->state, 0, 2),
        'country' => $faker->country,
        'country_code' => $faker->countryCode,
        'currency' => $faker->currencyCode,
        'presentment_currencies' => array_map(function () use ($faker) {
            return $faker->unique()->currencyCode;
        }, range(1, rand(1, 20))),
        'money_format' => '${{amount}}',
        'money_with_currency_format' => '${{amount}} USD',
        'money_in_email_format' => '${{amount}}',
        'money_with_currency_in_email_format' => '${{amount}} USD',
        'timezone_offset' => $faker->randomElement(['-', '+']).rand(0, 12).':'.$faker->randomElement(['00', '15', '30', '45']),
        'iana_timezone' => $faker->timezone,
        'shopify_plan_display_name' => 'basic',
        'shopify_partner' => false,
        'shopify_plus' => false,
        'shopify_scopes' => [],
    ];
});
