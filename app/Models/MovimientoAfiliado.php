<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoAfiliado extends Model
{
    protected $table = 'movimientos_afiliados';
    protected $fillable = ['afiliado_id', 'tipo_movimiento', 'puntos_delta'];
}
