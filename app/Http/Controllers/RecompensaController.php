<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recompensa;
use App\Models\Afiliado;
use App\Models\MovimientoAfiliado;

class RecompensaController extends Controller
{
    public function index()
    {
        return response()->json(Recompensa::all());
    }

    public function canjear(Request $request)
    {
        // 1. Validar que la app nos envíe los IDs necesarios
        $request->validate([
            'afiliado_id' => 'required|integer',
            'recompensa_id' => 'required|integer'
        ]);

        $afiliado = Afiliado::find($request->afiliado_id);
        $recompensa = Recompensa::find($request->recompensa_id);

        if (!$afiliado || !$recompensa) {
            return response()->json(['message' => 'Afiliado o Recompensa no encontrados'], 404);
        }

        // 2. Verificar si tiene puntos suficientes
        if ($afiliado->saldo_puntos < $recompensa->puntos_requeridos) {
            return response()->json(['message' => 'Puntos insuficientes para este canje'], 400);
        }

        // 3. Iniciar la transacción segura
        DB::beginTransaction();

        try {
            // A. Descontar los puntos del afiliado y guardar
            $afiliado->saldo_puntos -= $recompensa->puntos_requeridos;
            $afiliado->save();

            // B. Registrar el movimiento en el historial
            MovimientoAfiliado::create([
                'afiliado_id' => $afiliado->id,
                'tipo_movimiento' => 'canje',
                'puntos_delta' => -$recompensa->puntos_requeridos, // Puntos en negativo porque es resta
                'concepto' => 'Canje: ' . $recompensa->nombre,
                // Si tienes un campo recompensa_id en tu tabla de movimientos, descomenta la siguiente línea:
                // 'recompensa_id' => $recompensa->id 
            ]);

            // C. Confirmar que todo salió bien y aplicar los cambios en la BD
            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => '¡Recompensa canjeada con éxito!',
                'nuevo_saldo' => $afiliado->saldo_puntos
            ]);

        } catch (\Exception $e) {
            // Si algo falla, revertimos los cambios para no afectar los puntos
            DB::rollBack();
            return response()->json(['message' => 'Error interno al procesar el canje.', 'error' => $e->getMessage()], 500);
        }
    }
}