<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\TipoPropiedad;
use App\Models\TipoEstancia;
use App\Models\Filtro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PropiedadController extends Controller
{
    /**
     * Muestra una lista de todas las propiedades (con Inner Join).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Iniciar la consulta base con la carga ansiosa
        $query = Propiedad::with(['user', 'tipoPropiedad', 'tipoEstancia', 'imagenes']);

        // 2. Verificar el usuario autenticado y aplicar filtros de seguridad
        if (auth()->check()) {
            $user = auth()->user();
            
            // =================================================================
            // ** CONFIGURACIÓN DE ROL: SUSTITUYE EL VALOR 1 POR EL ID REAL DEL ROL ADMIN **
            // Esto asume que tienes un campo `id_rol` en tu tabla `users`.
            // =================================================================
            $ID_ROL_ADMIN = 3; // <<-- MODIFICA ESTE VALOR SI TU ID DE ADMIN ES DIFERENTE
            
            // Si el usuario NO es el administrador ($user->id_rol !== ID_ROL_ADMIN),
            // restringir la consulta para que solo muestre sus propiedades.
            if ($user->id_rol !== $ID_ROL_ADMIN) {
                $query->where('id_usuario', $user->id);
            }
            // Si es administrador, no se añade el `where`, por lo que se mostrarán todas las propiedades.
            
        } else {
            // Si no hay usuario autenticado (aunque debería ser cubierto por middleware de auth),
            // aseguramos que no se muestre nada.
            $query->where('id_usuario', 0);
        }


        // 3. Aplicar orden y paginación
        $propiedades = $query->latest()->paginate(10); 

        return view('propiedades.index', compact('propiedades'));
    }

    /**
     * Muestra el formulario para crear una nueva propiedad.
     * Reutiliza la vista 'cargar_inmueble'.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $propiedad = new Propiedad(); // Propiedad vacía para el formulario de creación
        $tiposPropiedad = TipoPropiedad::all();
        $tiposEstancia = TipoEstancia::all();
        $filtros = Filtro::all()->groupBy('categoria'); // Agrupar para los checkboxes
        $action = route('propiedades.store'); // Ruta de guardado

        return view('propiedades.create_edit', compact(
            'propiedad',
            'tiposPropiedad',
            'tiposEstancia',
            'filtros',
            'action'
        ));
    }

    /**
     * Almacena una propiedad recién creada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'accommodationType' => 'required|exists:tipos_propiedades,id',
            'typeOfStay' => 'required|exists:tipos_estancia,id',
            'price' => 'required|numeric|min:0',
            'neighborhood' => 'required|string|max:255',
            'rooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3072', // 3MB máx
        ]);

        try {
            // Limpiar el precio (se asume que se envían sin puntos por el JS)
            $price = str_replace('.', '', $request->price);
            
            // 1. Crear la Propiedad
            $propiedad = Propiedad::create([
                'id_usuario' => auth()->id(), // Asignar al usuario autenticado (Propietario)
                'id_tipo_propiedad' => $validatedData['accommodationType'],
                'id_tipo_estancia' => $validatedData['typeOfStay'],
                'titulo' => $validatedData['title'],
                'descripcion' => $validatedData['description'],
                'barrio' => $validatedData['neighborhood'],
                'latitud' => $validatedData['lat'],
                'longitud' => $validatedData['lng'],
                'precio_pesos' => floatval($price),
                'numero_habitaciones' => $validatedData['rooms'] ?? 0,
                'numero_baños' => $validatedData['bathrooms'] ?? 0,
                // Puedes añadir aquí 'tiene_patio', 'amueblado', 'tiene_parking' si los agregas al form
            ]);

            // 2. Manejar la carga de Imágenes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    if ($file) {
                        $path = $file->store('public/propiedades');
                        $propiedad->imagenes()->create(['url_imagen' => Storage::url($path)]);
                    }
                }
            }

            // 3. Sincronizar Filtros (Servicios)
            // Recolectar todos los checkboxes de servicios
            $filtroSlugs = [];
            foreach (['facility', 'roomService', 'groupType', 'funType'] as $category) {
                if ($request->has($category)) {
                    $filtroSlugs = array_merge($filtroSlugs, $request->input($category));
                }
            }
            
            if (!empty($filtroSlugs)) {
                // Obtener los IDs de Filtro basados en los slugs
                $filtroIds = Filtro::whereIn('slug', $filtroSlugs)->pluck('id')->toArray();
                $propiedad->filtros()->sync($filtroIds);
            }


            return redirect()->route('propiedades.index')->with('success', 'Propiedad creada exitosamente.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al guardar la propiedad: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para editar una propiedad existente.
     *
     * @param  \App\Models\Propiedad  $propiedad
     * @return \Illuminate\View\View
     */
    public function edit(Propiedad $propiedad)
    {
        $tiposPropiedad = TipoPropiedad::all();
        $tiposEstancia = TipoEstancia::all();
        $filtros = Filtro::all()->groupBy('categoria');
        $action = route('propiedades.update', $propiedad); // Ruta de actualización

        // IDs de filtros de la propiedad para marcar en el formulario
        $propiedadFiltroIds = $propiedad->filtros->pluck('id')->toArray();

        return view('propiedades.create_edit', compact(
            'propiedad',
            'tiposPropiedad',
            'tiposEstancia',
            'filtros',
            'action',
            'propiedadFiltroIds'
        ));
    }

    /**
     * Actualiza la propiedad especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Propiedad  $propiedad
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Propiedad $propiedad)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'accommodationType' => 'required|exists:tipos_propiedades,id',
            'typeOfStay' => 'required|exists:tipos_estancia,id',
            'price' => 'required|numeric|min:0',
            'neighborhood' => 'required|string|max:255',
            'rooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        try {
            // Limpiar el precio
            $price = str_replace('.', '', $request->price);

            // 1. Actualizar la Propiedad
            $propiedad->update([
                // 'id_usuario' NO se actualiza
                'id_tipo_propiedad' => $validatedData['accommodationType'],
                'id_tipo_estancia' => $validatedData['typeOfStay'],
                'titulo' => $validatedData['title'],
                'descripcion' => $validatedData['description'],
                'barrio' => $validatedData['neighborhood'],
                'latitud' => $validatedData['lat'],
                'longitud' => $validatedData['lng'],
                'precio_pesos' => floatval($price),
                'numero_habitaciones' => $validatedData['rooms'] ?? 0,
                'numero_baños' => $validatedData['bathrooms'] ?? 0,
            ]);

            // NOTA: La lógica de actualización de imágenes es compleja. Aquí solo se añadirían nuevas.
            // Para la edición real, necesitarías IDs o un sistema para eliminar las viejas.
            // Por simplicidad, solo añadiremos nuevas imágenes si se suben.
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    if ($file) {
                        $path = $file->store('public/propiedades');
                        $propiedad->imagenes()->create(['url_imagen' => Storage::url($path)]);
                    }
                }
            }


            // 3. Sincronizar Filtros (Servicios)
            $filtroSlugs = [];
            foreach (['facility', 'roomService', 'groupType', 'funType'] as $category) {
                if ($request->has($category)) {
                    $filtroSlugs = array_merge($filtroSlugs, $request->input($category));
                }
            }
            
            // Obtener los IDs de Filtro y sincronizar. Si está vacío, desasocia todos.
            if (!empty($filtroSlugs)) {
                $filtroIds = Filtro::whereIn('slug', $filtroSlugs)->pluck('id')->toArray();
                $propiedad->filtros()->sync($filtroIds);
            } else {
                 $propiedad->filtros()->sync([]); // Desasociar todos si no se marcó ninguno
            }


            return redirect()->route('propiedades.index')->with('success', 'Propiedad actualizada exitosamente.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar la propiedad: ' . $e->getMessage());
        }
    }

    /**
     * Elimina la propiedad especificada de la base de datos.
     *
     * @param  \App\Models\Propiedad  $propiedad
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Propiedad $propiedad)
    {
        try {
            // Opcional: Eliminar los archivos de imagen del storage
            // foreach ($propiedad->imagenes as $imagen) {
            //     Storage::delete(str_replace('/storage', 'public', $imagen->url_imagen));
            // }

            // 1. Eliminar imágenes relacionadas (Por CASCADE o eliminar explícitamente)
            $propiedad->imagenes()->delete(); 
            // 2. Eliminar filtros relacionados (La tabla pivote se limpia automáticamente con sync/detach, pero al borrar la propiedad debe hacerse antes si no hay ON DELETE CASCADE)
            $propiedad->filtros()->detach(); 
            // 3. Eliminar la Propiedad
            $propiedad->delete();

            return redirect()->route('propiedades.index')->with('success', 'Propiedad eliminada exitosamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la propiedad: ' . $e->getMessage());
        }
    }
}