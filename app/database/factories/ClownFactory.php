<?php

namespace Database\Factories;

use App\Models\Clown;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Clown>
 */
class ClownFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->name(),
            'email'       => fake()->unique()->safeEmail(),
            'description' => fake()->sentence(),
            'rating'      => fake()->numberBetween(1, 5),
            'status'      => fake()->randomElement(['active', 'passive', 'unknown']),
        ];
    }
}
