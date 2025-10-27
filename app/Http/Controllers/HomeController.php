<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Propiedad::with(['usuario', 'tipo']); // eager loading

        // Filtro por tipo de propiedad
        if ($request->filled('id_tipo_propiedad')) {
            $query->where('id_tipo_propiedad', $request->id_tipo_propiedad);
        }

        // Ejemplo: si quisieras filtrar por fecha de publicación
        if ($request->filled('fecha_publicacion')) {
            $query->whereDate('fecha_publicacion', '>=', $request->fecha_publicacion);
        }

        $propiedades = $query->get();

        return view('home.home', compact('propiedades'));
    }
}
