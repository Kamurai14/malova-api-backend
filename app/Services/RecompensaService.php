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
        // 1. Buscamos la recompensa (esto no necesita bloqueo porque su costo no cambia)
        $recompensa = Recompensa::find($recompensaId);
        
        if (!$recompensa) {
            throw new Exception('Recompensa no encontrada', 404);
        }

        // 2. Iniciamos la transacción ANTES de buscar al afiliado
        DB::beginTransaction();

        try {
            // 3. BLOQUEO PESIMISTA: Leemos el saldo y bloqueamos la fila hasta hacer el commit
            $afiliado = Afiliado::where('id', $afiliadoId)->lockForUpdate()->first();

            if (!$afiliado) {
                throw new Exception('Afiliado no encontrado', 404);
            }

            if ($afiliado->saldo_puntos < $recompensa->puntos_requeridos) {
                throw new Exception('Puntos insuficientes para este canje', 400);
            }

            // Descontamos y guardamos
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
            // Respetamos el código de error original (400, 404) si lo mandamos nosotros
            $codigo = $e->getCode() ?: 500;
            throw new Exception($e->getMessage(), $codigo);
        }
    }
}