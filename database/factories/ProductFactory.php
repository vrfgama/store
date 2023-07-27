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
    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->words(3, true)),
            'ean' => fake()->ean13,
            'description' => ucfirst(fake()->sentence(5)),
            'price' => fake()->randomFloat(2, 1, 90),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
