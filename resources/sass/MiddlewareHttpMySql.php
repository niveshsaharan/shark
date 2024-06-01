<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->slug,
            'shopify_domain' => $this->faker->unique()->slug.'.myshopify.com',
            'shopify_token' => $this->faker->password,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'shopify_grandfathered' => false,
            'shopify_freemium' => false,
            'shopify_gid' => 'gid://shopify/Shop/'.$this->faker->unique()->numberBetween(1000000000, 9999999999),
            'domain' => $this->faker->domainName,
            'shop_name' => $this->faker->name,
            'contact_email' => $this->faker->email,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'province_code' => substr($this->faker->state, 0, 2),
            'country' => $this->faker->country,
            'country_code' => $this->faker->countryCode,
            'currency' => $this->faker->currencyCode,
            'presentment_currencies' => array_map(function () {
                return $this->faker->unique()->currencyCode;
            }, range(1, rand(1, 20))),
            'money_format' => '${{amount}}',
            'money_with_currency_format' => '${{amount}} USD',
            'money_in_email_format' => '${{amount}}',
            'money_with_currency_in_email_format' => '${{amount}} USD',
            'timezone_offset' => $this->faker->randomElement(['-', '+']).rand(0, 12).':'.$this->faker->randomElement(['00', '15', '30', '45']),
            'iana_timezone' => $this->faker->timezone,
            'shopify_plan_display_name' => 'basic',
            'shopify_partner' => false,
            'shopify_plus' => false,
            'shopify_scopes' => [],
        ];
    }

    /**
     * Grandfathered shop
     *
     * @return \Database\Factories\UserFactory
     */
    public function grandfathered()
    {
        return $this->state(function (array $attributes) {
            return [
                'shopify_grandfathered' => true,
            ];
        });
    }
}
