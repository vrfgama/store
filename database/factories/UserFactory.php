<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\NullType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $gender= fake()->randomElement(['m', 'f']);

        if($gender == 'm')
            $name= fake()->firstNameMale;
        else  
            $name= fake()->firstNameFemale;
            

        $name .= ' ' . fake()->lastName;
        
        $email= $this->email($name);
        
        return [
            'name' => $name,
            'email' => $email,
            //'email_verified_at' => now(),
            //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('123'),
            //'remember_token' => Str::random(10),
            'birth' => fake()->date,
            'gender' => $gender,
            'fone' => fake()->cellphone,
            'rg' => fake()->rg(false),
            'cpf' => fake()->cpf(false)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


    public function email($name): string
    {
        
        $name= iconv("UTF-8", "ASCII//TRANSLIT", $name);
        $name= str_replace([' ', "'", '`', '^', '~'], ['-', ''], $name);
        $name= strtolower($name);
        $name= $name . '@mail.com'; 

        return $name;
    }
}
