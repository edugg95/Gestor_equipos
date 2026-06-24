<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //Importamos la clase User
use Illuminate\Support\Facades\Hash; //Herramienta para encriptar contraseñas

class RegistroController extends Controller
{
    //Mostrar la página de registro
    public function index()
    {
        return view('registro');
    }

    //Guardar el usuario en la base de datos 

    public function store(Request $request)
    {
        //Crear un nuevo objeto  usuario
        $usuario = new User();

        //Le metemos los datos del formulario
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        //Encriptamos la contraseña antes de guardar
        $usuario->password = Hash::make($request->password);

        //Guardamos el objeto en la base de datos
        $usuario->save();

        //Una vez registrado, redirigimos al login
        return redirect('/login');
    }
}