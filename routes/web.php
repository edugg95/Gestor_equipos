<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;

Route::get('/', function () {
    return view('welcome');
});

//Ruta para mostrar la lista de equipos
Route::get('/equipos', [EquipoController::class, 'index']);
