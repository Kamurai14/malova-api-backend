<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovimientoAfiliado;

class MovimientosTableSeeder extends Seeder
{
    public function run()
    {
        MovimientoAfiliado::create([
            'afiliado_id' => 1, // Se lo asignamos a Juan Pérez
            'tipo_movimiento' => 'acumulacion',
            'puntos_delta' => 150
        ]);
    }
}