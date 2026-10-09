<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompensa;

class RecompensaController extends Controller
{
    public function index()
    {
        return response()->json(Recompensa::all());
    }
}
