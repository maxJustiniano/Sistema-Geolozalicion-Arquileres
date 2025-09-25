<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Mostrar formulario login
    public function create()
    {
        return view('auth.login');
    }

    // Procesar login
    public function store(Request $request)
    {
        //Validar credenciales
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ]);
    }

    // Logout
    public function destroyer(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
