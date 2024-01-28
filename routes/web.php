<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimuladorController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para Amortización Alemana
Route::get('/simulador/amortizacion-alemana', [SimuladorController::class, 'formAmortizacionAlemana']);
Route::post('/simulador/amortizacion-alemana', [SimuladorController::class, 'calcularAmortizacionAlemana']); 
Route::get('/simulador/amortizacion-alemana/pdf', [SimuladorController::class, 'descargarPdfAmortizacionAlemana']);

// Rutas para Amortización Francesa
Route::get('/simulador/amortizacion-francesa/pdf', [SimuladorController::class, 'descargarPdfAmortizacionFrancesa']);
Route::get('/simulador/amortizacion-francesa', [SimuladorController::class, 'formAmortizacionFrancesa']);
Route::post('/simulador/amortizacion-francesa', [SimuladorController::class, 'calcularAmortizacionFrancesa']); 
