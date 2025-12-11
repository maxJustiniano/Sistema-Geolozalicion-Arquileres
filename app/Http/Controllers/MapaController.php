<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Propiedad;
use App\Http\Resources\PropiedadMapResource;

class MapaController extends Controller
{
    public function index()
    {
        // Usamos 'with' para traer todas las relaciones de una sola vez (Eager Loading)
        // Esto evita que la BD haga cientos de consultas.
        $propiedades = Propiedad::with(['tipoPropiedad', 'tipoEstancia', 'filtros','imagenes'])->get();

        // Devuelve el JSON formateado
        return PropiedadMapResource::collection($propiedades);
    }
}