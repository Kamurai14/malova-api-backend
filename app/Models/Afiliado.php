<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    // Le decimos a Laravel cuáles columnas de la tabla puede modificar
    protected $fillable = ['folio', 'nombre', 'nivel', 'saldo_puntos'];
}