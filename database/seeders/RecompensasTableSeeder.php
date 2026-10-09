<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recompensa;

class RecompensasTableSeeder extends Seeder
{
    public function run()
    {
        Recompensa::create([
            'nombre' => 'Gorra Malova Oficial',
            'descripcion' => 'Gorra de trabajo resistente al sol.',
            'puntos_requeridos' => 100,
            'tipo' => 'mercancia'
        ]);

        Recompensa::create([
            'nombre' => 'Descuento 10% en Tubería',
            'descripcion' => 'Aplica para compras de tubería PVC.',
            'puntos_requeridos' => 200,
            'tipo' => 'descuento'
        ]);
    }
}