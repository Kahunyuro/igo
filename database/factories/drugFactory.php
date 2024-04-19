<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\drug>
 */
class drugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    
        {
            return [
                'name' => fake()->word(),
                'description' => fake()->unique()->word(),
                'price' => fake()->numberBetween(20, 2000),
                'quantity' => fake()->numberBetween(20, 2000),
            ];
        }
    
}
