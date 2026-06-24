<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;

Route::get('/login', function () {
    return view('login');
})->name('login');


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

//Ruta para mostrar la página de registro
Route::get('/registro', [RegistroController::class, 'index']);

//Ruta para recibir los datos del formulario y guardarlos
Route::post('/registro', [RegistroController::class, 'store']);

//Ruta para mostrar la página de login
Route::post('/login', [LoginController::class, 'authenticate']);

// Para entrar al inventario de equipos hay que pasar OBLIGATORIAMENTE por el filtro de autenticación"
Route::get('/equipos', [EquipoController::class, 'index'])->middleware('auth');