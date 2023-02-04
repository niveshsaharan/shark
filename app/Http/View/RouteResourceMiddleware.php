<?php

namespace Database\Factories;

use App\Models\Tester;
use Illuminate\Database\Eloquent\Factories\Factory;

class TesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tester::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shopify_domain' => $this->faker->unique()->slug.'.myshopify.com',
            'expires_at' => null,
        ];
    }
}
