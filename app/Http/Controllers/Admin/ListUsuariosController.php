<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ListUsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('admin.listusuarios', compact('usuarios'));
    }
}
