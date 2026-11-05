<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovimientoAfiliado;

class MovimientosTableSeeder extends Seeder
{
    public function run()
    {
        // Movimiento inicial para Juan Pérez (id: 1) que tiene 150 de saldo
        MovimientoAfiliado::create([
            'afiliado_id' => 1,
            'tipo_movimiento' => 'acumulacion',
            'puntos_delta' => 150,
            'concepto' => 'Bono de bienvenida'
        ]);

        // Movimiento inicial para María García (id: 2) que tiene 300 de saldo
        MovimientoAfiliado::create([
            'afiliado_id' => 2,
            'tipo_movimiento' => 'acumulacion',
            'puntos_delta' => 300,
            'concepto' => 'Bono de bienvenida'
        ]);

        // Movimiento inicial para Carlos López (id: 3) que tiene 50 de saldo
        MovimientoAfiliado::create([
            'afiliado_id' => 3,
            'tipo_movimiento' => 'acumulacion',
            'puntos_delta' => 50,
            'concepto' => 'Bono de bienvenida'
        ]);
    }
}