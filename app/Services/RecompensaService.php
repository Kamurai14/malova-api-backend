<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Recompensa;
use App\Models\Afiliado;
use App\Models\MovimientoAfiliado;
use Exception;

class RecompensaService
{
    public function procesarCanje(int $afiliadoId, int $recompensaId)
    {
        $afiliado = Afiliado::find($afiliadoId);
        $recompensa = Recompensa::find($recompensaId);

        if (!$afiliado || !$recompensa) {
            throw new Exception('Afiliado o Recompensa no encontrados', 404);
        }

        if ($afiliado->saldo_puntos < $recompensa->puntos_requeridos) {
            throw new Exception('Puntos insuficientes para este canje', 400);
        }

        DB::beginTransaction();

        try {
            $afiliado->saldo_puntos -= $recompensa->puntos_requeridos;
            $afiliado->save();

            MovimientoAfiliado::create([
                'afiliado_id' => $afiliado->id,
                'tipo_movimiento' => 'canje',
                'puntos_delta' => -$recompensa->puntos_requeridos,
                'concepto' => 'Canje: ' . $recompensa->nombre,
            ]);

            DB::commit();

            return [
                'success' => true, 
                'message' => '¡Recompensa canjeada con éxito!',
                'nuevo_saldo' => $afiliado->saldo_puntos
            ];

        } catch (Exception $e) {
            DB::rollBack();
            // Propagamos el error para que el controlador decida qué hacer
            throw new Exception('Error interno al procesar el canje: ' . $e->getMessage(), 500);
        }
    }
}