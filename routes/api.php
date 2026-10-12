<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\RecompensaController;
use App\Http\Controllers\MovimientoAfiliadoController;

Route::get('/afiliados', [AfiliadoController::class, 'index']);
Route::get('/recompensas', [RecompensaController::class, 'index']);
Route::get('/movimientos', [MovimientoAfiliadoController::class, 'index']);
// NUEVA RUTA PARA CANJES
Route::post('/canjear', [RecompensaController::class, 'canjear']);