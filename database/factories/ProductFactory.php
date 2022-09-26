<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentences(3),
            'price' => $this->faker->randomNumber(),
            'sku' => $this->faker->creditCardNumber(),
            'quantity' => $this->faker->randomNumber(1, 100),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
