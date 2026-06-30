<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;


// RUTAS PÚBLICAS 

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/registro', [RegistroController::class, 'index']);
Route::post('/registro', [RegistroController::class, 'store']);



// RUTAS PROTEGIDAS (Solo usuarios logueados)

Route::middleware(['auth'])->group(function () {
    
    //Inventario
    Route::get('/equipos', [EquipoController::class, 'index']);
    
    //Crear equipos
    Route::get('/equipos/crear', [EquipoController::class, 'create']);
    Route::post('/equipos', [EquipoController::class, 'store']);
    
    //Editar y actualizar equipos
    Route::get('/equipos/{id}/editar', [EquipoController::class, 'edit']);
    Route::put('/equipos/{id}', [EquipoController::class, 'update']);
    
    //Borrar equipos
    Route::delete('/equipos/{id}', [EquipoController::class, 'destroy']);
    
    //Logout
    Route::post('/logout', [LoginController::class, 'logout']);
    
});