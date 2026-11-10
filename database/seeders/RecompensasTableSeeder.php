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
            'tipo' => 'mercancia',
            'puntos_requeridos' => 100,
            'activo' => true
        ]);

        Recompensa::create([
            'nombre' => 'Descuento 10% en Herramientas',
            'tipo' => 'descuento',
            'puntos_requeridos' => 500,
            'activo' => true
        ]);

        Recompensa::create([
            'nombre' => 'Bono $200 en Efectivo',
            'tipo' => 'efectivo',
            'puntos_requeridos' => 3000,
            'activo' => true
        ]);
    }
}