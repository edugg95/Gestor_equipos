<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;

Route::get('/', function () {
    return view('welcome');
});

//Ruta para mostrar la lista de equipos
Route::get('/equipos', [EquipoController::class, 'index']);

//Ruta para mostrar el formulario para crear un nuevo equipo
Route::get('/equipos/crear', [EquipoController::class, 'create']);

//Ruta POST para recibir los datos del formulario y guardarlos
Route::post('/equipos', [EquipoController::class, 'store']);

//Ruta para mostrar el formulario de edición de un equipo específico
Route::get('/equipos/{id}/editar', [EquipoController::class, 'edit']);

//Ruta para recibir los datos editados y actualizar el equipo en la BD
Route::put('/equipos/{id}', [EquipoController::class, 'update']);

//Ruta para eliminar un equipo de la base de datos
Route::delete('/equipos/{id}', [EquipoController::class, 'destroy']);