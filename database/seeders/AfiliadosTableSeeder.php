<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afiliado; 

class AfiliadosTableSeeder extends Seeder
{
    public function run()
    {
        Afiliado::create([
            'folio' => 'MAL-001',
            'nombre' => 'Juan Pérez',
            'nivel' => 'plomero',
            'saldo_puntos' => 150
        ]);

        Afiliado::create([
            'folio' => 'MAL-002',
            'nombre' => 'María García',
            'nivel' => 'electricista',
            'saldo_puntos' => 300
        ]);

        Afiliado::create([
            'folio' => 'MAL-003',
            'nombre' => 'Carlos López',
            'nivel' => 'albañil',
            'saldo_puntos' => 50
        ]);
    }
}