<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Salida;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salida>
 */
class SalidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' =>fake()->date(),
            'hora' =>fake()->time(),
            'cantidad'=>fake()->numberBetween(1,100),
            'cliente'=>fake()->name(),
            'product_id'=>Product::all()->random()->id,
        ];
    }
}
