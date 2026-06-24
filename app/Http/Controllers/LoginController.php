<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Herramienta para gestionar sesiones

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        //Recogemos lo que el usuario ha escrito en las casillas
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auth::attempt  Coge el email y la contraseña, busca en la base de datos si existe, 
        if (Auth::attempt($credenciales)) {
            
            // Si coincide, le creamos un pase temporal (sesión segura)
            // regenerate () crea una sesión nueva y segura en el navegador
            $request->session()->regenerate();

            // lo mandamos al inventario de equipos
            return redirect('/equipos');
        }

        //Si no coincide, le devolvemos a la puerta (login) con un error
        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ]);
    }
}