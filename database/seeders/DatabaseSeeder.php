<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Entrada;
use App\Models\Salida;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Product::factory(500)->create();
        // Entrada::factory(1000)->create();
        // Salida::factory(1000)->create();



        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        // \App\Models\Product::factory()->create([
        //     'referencia' => '0001',
        //     'nombre' => 'Producto 1',
        //     'cantidad' => 10,
        //     'stock' => 'Stock 1',
        // ]);
    }
}
