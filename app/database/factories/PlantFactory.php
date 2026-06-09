<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name'        => ucfirst($name),
            'slug'        => \Illuminate\Support\Str::slug($name),
            'description' => fake()->sentence(),
            'stock'       => (string) fake()->numberBetween(1, 100),
        ];
    }
}
