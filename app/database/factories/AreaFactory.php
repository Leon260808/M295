<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->city();

        return [
            'plant_id'    => \App\Models\Plant::factory(),
            'name'        => $name,
            'slug'        => \Illuminate\Support\Str::slug($name),
            'description' => fake()->sentence(),
            'address'     => fake()->streetAddress(),
            'city'        => fake()->city(),
            'zip'         => fake()->postcode(),
        ];
    }
}
