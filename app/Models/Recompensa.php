<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'puntos_requeridos', 'tipo', 'activo'];
}
