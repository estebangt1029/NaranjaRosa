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
            'referencia' =>fake()->numberBetween(0001,9999),
            'nombre' =>fake()->name(),
            'cantidad'=>fake()->numberBetween(20,100),
            'stock' =>fake()->numberBetween(1,10),
        ];
    }
}
