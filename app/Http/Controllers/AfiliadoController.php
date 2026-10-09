<?php

namespace App\Http\Controllers;

use App\Models\Afiliado; // Importamos el modelo
use Illuminate\Http\Request;

class AfiliadoController extends Controller
{
    public function index()
    {
        $afiliados = Afiliado::all();
        return response()->json($afiliados);
    }
}