<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MovimientoAfiliado;

class Afiliado extends Model
{
    protected $fillable = ['folio', 'nombre', 'nivel', 'saldo_puntos'];

    // Le decimos a Laravel que SIEMPRE adjunte este campo virtual cuando hagamos un Afiliado::all() o Afiliado::find()
    protected $appends = ['puntos_historicos'];

    /**
     * Accesor para calcular los puntos históricos.
     * Suma todos los 'puntos_delta' de los movimientos que sean 'acumulacion'.
     */
    public function getPuntosHistoricosAttribute()
    {
        return MovimientoAfiliado::where('afiliado_id', $this->id)
            ->where('tipo_movimiento', 'acumulacion')
            ->sum('puntos_delta');
    }

    /**
     * Accesor para evaluar el nivel automáticamente basado en los puntos históricos.
     * Sobrescribe el valor estático de la base de datos.
     */
    public function getNivelAttribute()
    {
        $puntos = $this->puntos_historicos; 

        if ($puntos >= 5000) {
            return 'platino';
        } elseif ($puntos >= 3000) {
            return 'oro';
        } elseif ($puntos >= 1000) {
            return 'plata';
        } elseif ($puntos >= 500) {
            return 'bronce'; 
        }

        // De 0 a 499 puntos es Plomero, el nivel base de entrada al programa
        return 'plomero'; 
    }
}