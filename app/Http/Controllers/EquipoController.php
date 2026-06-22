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

    public function create()
    {
    return view('crear');

    }

    public function store(Request $request) {

        //Crear un nuevo objeto  equipo
        $nuevoEquipo = new Equipo();

        //Le metemos los datos del formulario
        $nuevoEquipo->marca = $request->marca;
        $nuevoEquipo->modelo = $request->modelo;
        $nuevoEquipo->estado = $request->estado;

        //Guardamos el objeto en la base de datos
        $nuevoEquipo->save();

        //Redireccionamos a la lista de equipos
        return redirect('/equipos');
    }

    // Función para mostrar el formulario de edición con los datos cargados
    public function edit($id)
    {
        //Buscamos el equipo concreto por su ID
        $equipoParaEditar = Equipo::find($id);

        //Cargamos la vista 'editar' y le pasamos los datos de ese equipo
        return view('editar', compact('equipoParaEditar'));
    }

    //Función para procesar la edición del equipo en MySQL
    public function update(Request $request, $id)
    {
        //Buscamos el equipo existente en la base de datos por su ID
        $equipoEncontrado = Equipo::find($id);

        //Sustituimos los datos viejos por los nuevos
        $equipoEncontrado->marca = $request->marca;
        $equipoEncontrado->modelo = $request->modelo;
        $equipoEncontrado->estado = $request->estado;

        // Guardamos los cambios en MySQL
        $equipoEncontrado->save();

        //Redirigimos al inventario principal
        return redirect('/equipos');
    }

    // Función para eliminar un equipo
    public function destroy($id)
    {
        //Buscamos el equipo
        $equipoParaBorrar = Equipo::find($id);

        //Lo eliminamos permanentemente de MySQL
        $equipoParaBorrar->delete();

        //Volvems a la tabla principal
        return redirect('/equipos');
    }
}
 