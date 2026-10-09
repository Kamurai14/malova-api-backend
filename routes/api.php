<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;

Route::get('/afiliados', [AfiliadoController::class, 'index']);