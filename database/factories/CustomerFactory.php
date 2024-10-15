<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->date('Y-m-d'),
            'email' => fake()->unique()->safeEmail(),
            'card_number' => fake()->unique()->randomNumber(6),
            'phone_number' => fake()->randomNumber(6),
            'image_path' => 'default_customer_image.jpg',
        ];
    }
}
