<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EnfermoController;


// Ruta principal: muestra la vista personalizada
Route::get('/', function () {
    return view('home');
});

// Rutas del módulo de enfermedades
Route::resource('enfermedades', EnfermoController::class);

// Rutas del módulo de logins (solo index)
Route::resource('logins', LoginController::class)->only(['index']);
