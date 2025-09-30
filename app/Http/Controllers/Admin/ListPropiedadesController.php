<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Propiedad;

class ListPropiedadesController extends Controller
{
    public function index()
    {
        $propiedades = Propiedad::all();

        return view('admin.listpropiedades', compact('propiedades'));
    }
}
