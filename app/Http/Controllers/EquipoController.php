<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    //Funcion para mostrar la lista de equipos
    public function index(\Illuminate\Http\Request $request) {
    
    //Consulta de los filtros
    $consulta = \App\Models\Equipo::query();

    //filtro por marca y modelo
    if ($request->has('buscar') && $request->buscar != '') {
        $texto = $request->buscar;
        // Buscamos si el texto coincide con la marca o con el modelo
        $consulta->where(function($q) use ($texto) {
            $q->where('marca', 'like', '%' . $texto . '%')
              ->orWhere('modelo', 'like', '%' . $texto . '%');
        });
    }

    //Filtro por estado
    if ($request->has('estado') && $request->estado != '') {
        $consulta->where('estado', $request->estado);
    }

    //Una vez aplicados los filtros, EJECUTAMOS la búsqueda en la BBDD
    //Usamos latest() para que los últimos creados salgan los primeros
    
    //Implementamos paginación para que salgan de 10 a 10 equipos por página.
    //Con el método withQueryString() le pasamos el query string preservado a la vista 
    //Esta directiva garantiza que los parámetros GET se concatenen a los enlaces de paginación
    $equipos = $consulta->latest()->paginate(10)->withQueryString();

    //Se lo pasamos a la Vista
    return view('equipos', compact('equipos'));
    }


    public function create()
    {
    return view('crear');

    }

    //Función para crear nuevo equipo
    public function store(Request $request) {

        //Validamos los datos del formulario
        $request->validate([
            'marca'  => 'required|string',
            'modelo' => 'required|string',
            'estado' => 'required|in:Disponible,Asignado,Reparacion',
        ], [
            'marca.required'  => 'Por favor, escribe la marca del equipo.',
            'modelo.required' => 'Por favor, escribe el modelo del equipo.',
            'estado.required' => 'Debes seleccionar un estado de la lista.',
        ]);

        $nuevoEquipo = new Equipo();
        $nuevoEquipo->marca = $request->marca;
        $nuevoEquipo->modelo = $request->modelo;
        $nuevoEquipo->estado = $request->estado;
        
        $nuevoEquipo->save();

       
        return redirect('/equipos')->with('success', 'Equipo creado correctamente.');
    }

    // Función mostrar datos completos de edición
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
        //Validamos los datos del formulario
         $request->validate([
            'marca'  => 'required|string',
            'modelo' => 'required|string',
            'estado' => 'required|in:Disponible,Asignado,Reparacion',
        ], [
            'marca.required'  => 'Por favor, escribe la marca del equipo.',
            'modelo.required' => 'Por favor, escribe el modelo del equipo.',
            'estado.required' => 'Debes seleccionar un estado de la lista.',
        ]);

        //Buscamos el equipo existente en la base de datos por su ID
        $equipoEncontrado = Equipo::find($id);

        //Sustituimos los datos viejos por los nuevos
        $equipoEncontrado->marca = $request->marca;
        $equipoEncontrado->modelo = $request->modelo;
        $equipoEncontrado->estado = $request->estado;

        // Guardamos los cambios en MySQL
        $equipoEncontrado->save();

        //Redirigimos al inventario principal
       return redirect('/equipos')->with('success', 'El equipo se ha actualizado correctamente.');
    }

    // Función para eliminar un equipo
    public function destroy($id)
    {
        //Buscamos el equipo
        $equipoParaBorrar = Equipo::find($id);

        //Lo eliminamos permanentemente de MySQL
        $equipoParaBorrar->delete();

        //Volvems a la tabla principal
        return redirect('/equipos')->with('success', 'El equipo ha sido eliminado del sistema.');
    }
}
 