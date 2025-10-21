<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EnfermoController;
use App\Http\Controllers\AsistenteController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí definimos todas las rutas accesibles desde la aplicación web.
| Incluye el módulo de enfermedades, logins y el asistente médico.
|
*/

// 🏠 Página principal
Route::get('/', function () {
    return view('home');
});

// 🧬 Módulo de enfermedades
Route::resource('enfermedades', EnfermoController::class);

// 🔐 Módulo de logins (solo index)
Route::resource('logins', LoginController::class)->only(['index']);

// 🤖 Rutas del asistente médico
Route::post('/asistente', [AsistenteController::class, 'analizar'])->name('asistente.analizar');
Route::get('/historial', [AsistenteController::class, 'historial'])->name('asistente.historial');
Route::get('/historial-pacientes', [AsistenteController::class, 'historialPacientes'])->name('asistente.historialPacientes');