<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Necesario para buscar el rol
use App\Models\Propiedad; // Modelo Propiedad
use App\Models\ImagenPropiedad; // Modelo ImagenPropiedad
use App\Models\Filtro; // Modelo Filtro
use App\Models\User; // Asumo que tienes este modelo para el usuario demo

class InmuebleController extends Controller
{
    public function store(Request $request)
    {
        // 1. Limpieza del precio (quitar puntos de miles para que sea numérico)
        $precioLimpio = str_replace('.', '', $request->input('price'));
        $request->merge(['price' => $precioLimpio]);

        // 2. Validación (Necesaria antes de guardar)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'accommodationType' => 'required|integer', // Es el ID del TipoPropiedad
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'neighborhood' => 'required|string|max:255',
            'description' => 'required|string',
            'rooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'typeOfStay' => 'required|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3072', // Máx 3MB por imagen
            // Para los checkboxes (arrays), ¡ya corregidos en el blade!
            'facility' => 'nullable|array',
            'roomService' => 'nullable|array',
            'groupType' => 'nullable|array',
            'funType' => 'nullable|array',
        ]);

        // ===============================================
        // A. LÓGICA DEL USUARIO DEMO
        // ===============================================

        // 1. Obtener el ID del rol de 'propietario'
        $propietarioRole = DB::table('roles')->where('nombre_rol', 'propietario')->first();

        if (!$propietarioRole) {
            // Manejar error si el rol no existe (crucial para no fallar)
            return back()->with('error', "Error: El rol 'propietario' no se encontró en la base de datos.");
        }
        $propietarioRoleId = $propietarioRole->id;

        // 2. Crear un usuario dummy si no existe
        $user = User::firstOrCreate(
            ['email' => 'dummy@geolocalizacion.com'],
            [
                'id_rol' => $propietarioRoleId,
                'name' => 'Usuario Demo',
                'password' => bcrypt('password'),
                'nombre_persona' => 'Demo',
                'apellido_persona' => 'Propietario',
            ]
        );

        // ===============================================
        // B. CREACIÓN DE LA PROPIEDAD
        // ===============================================

        // Mapear los datos de la Request a los campos del modelo Propiedad
        $propiedad = Propiedad::create([
            'id_usuario' => $user->id,
            'id_tipo_propiedad' => $request->accommodationType,
            'id_tipo_estancia' => $request->typeOfStay, // <--- CAMBIO CLAVE
            'titulo' => $request->title,
            'descripcion' => $request->description,
            'barrio' => $request->neighborhood,
            'latitud' => $request->lat,
            'longitud' => $request->lng,
            'precio_pesos' => $request->price,
            'numero_habitaciones' => $request->rooms ?? 0,
            'numero_baños' => $request->bathrooms ?? 0,

            // Campos booleanos (ejemplo, ajusta según tu formulario si los incluyes)
            'tiene_patio' => false,
            'amueblado' => false,
            'tiene_parking' => in_array('estacionamiento', $request->facility ?? [])
        ]);

        // ===============================================
        // C. PROCESAMIENTO DE IMÁGENES
        // ===============================================

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generar nombre único: timestamp_nombreoriginal
                $nombreArchivo = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();

                // Mover a public/img/inmuebles
                $image->move(public_path('img/inmuebles'), $nombreArchivo);

                $rutaRelativa = 'img/inmuebles/' . $nombreArchivo;

                // Guardar en la tabla imagenes_propiedades usando el modelo
                $propiedad->imagenes()->create([
                    'url_imagen' => $rutaRelativa,
                    // 'id_propiedad' es llenado automáticamente por la relación
                ]);
            }
        }

        // ===============================================
        // D. PROCESAMIENTO DE FILTROS (Servicios/Amenities)
        // ===============================================

        // Recolectar todos los slugs de los filtros seleccionados
        $filtroSlugs = array_merge(
            $request->facility ?? [],
            $request->roomService ?? [],
            $request->groupType ?? [],
            $request->funType ?? []
        );

        if (!empty($filtroSlugs)) {
            // Buscar los IDs de los filtros por sus slugs (valores de los checkboxes)
            $filtroIds = Filtro::whereIn('slug', $filtroSlugs)->pluck('id')->toArray();

            if (!empty($filtroIds)) {
                // Usar la relación Many-to-Many para adjuntar los filtros
                // Esto inserta los IDs en la tabla pivote 'filtro_propiedades'
                $propiedad->filtros()->attach($filtroIds);
            }
        }

        // ===============================================
        // E. RESPUESTA FINAL
        // ===============================================


        return redirect()->route('cargar-inmueble')
            ->with('success', '¡Propiedad "' . $request['titulo'] . '" cargada con éxito!');
    }
}
