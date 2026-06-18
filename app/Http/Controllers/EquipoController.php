<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    //Funcion para mostrar la lista de equipos
    public function index()
    {
        //Obtener todos los equipos
        $equipos = Equipo::all();

        //Llamar a la vista con el modelo
        return view('equipos', ['misEquipos' => $equipos]);
    }
}
 