<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Places>
 */
class PlacesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'coordinates' => $this->faker->latitude() . ', ' . $this->faker->longitude(),
            'description' => $this->faker->paragraph(),
            'image' => fake()->imageUrl(),
        ];
    }
}
