<?php

namespace App\Http\Controllers;

use App\Models\MovimientoAfiliado;
use Illuminate\Http\Request;

class MovimientoAfiliadoController extends Controller
{
    public function index()
    {
        return response()->json(MovimientoAfiliado::all());
    }
}
