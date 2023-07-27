<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type= fake()->creditCardType();
        
        return [
            'number'=> fake()->creditCardNumber($type, true),
            'expiration_date'=> fake()->creditCardExpirationDate(),
            'type'=> $type,
            'cvv'=> fake()->numberBetween(100, 999)
        ];
    }
}
