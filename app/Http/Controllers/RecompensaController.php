<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompensa;
use App\Services\RecompensaService; // Importamos el servicio
use Exception;

class RecompensaController extends Controller
{
    protected RecompensaService $recompensaService;

    // Inyección de dependencias
    public function __construct(RecompensaService $recompensaService)
    {
        $this->recompensaService = $recompensaService;
    }

    public function index()
    {
        return response()->json(Recompensa::all());
    }

    public function canjear(Request $request)
    {
        $request->validate([
            'afiliado_id' => 'required|integer',
            'recompensa_id' => 'required|integer'
        ]);

        try {
            // Le pasamos el trabajo pesado al servicio
            $resultado = $this->recompensaService->procesarCanje(
                $request->afiliado_id, 
                $request->recompensa_id
            );
            
            return response()->json($resultado);
            
        } catch (Exception $e) {
            // Si el servicio lanza un error, el controlador lo atrapa y responde
            $codigo = $e->getCode() ?: 500;
            if ($codigo < 100 || $codigo > 599) $codigo = 500; // Seguridad de código HTTP
            
            return response()->json(['message' => $e->getMessage()], $codigo);
        }
    }
}