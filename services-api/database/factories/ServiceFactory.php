<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 10, 200),
            'is_active' => fake()->boolean,
            'location' => fake()->city,
            'contact_email' => fake()->email,
            'contact_phone' => fake()->phoneNumber,
        ];
    }
}
