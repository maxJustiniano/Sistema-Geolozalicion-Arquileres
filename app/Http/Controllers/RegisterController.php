<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    // Mostrar formulario registro
    public function create()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function store(Request $request)
    {
        //Validacion de datos post
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required|min:8|confirmed'
        ]);

        //Carga de datos a BD
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

}
