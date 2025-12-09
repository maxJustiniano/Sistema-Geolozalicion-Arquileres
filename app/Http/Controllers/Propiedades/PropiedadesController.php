<?php

namespace App\Http\Controllers\Propiedades;

use App\Models\Propiedades\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PropiedadesController
{
    /**
     * Almacena un nuevo recurso en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            // Campos obligatorios del formulario
            'title' => ['required', 'string', 'max:150'],
            'accommodationType' => ['required', 'exists:tipos_propiedades,id'], // ID del tipo de propiedad
            'neighborhood' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'numeric', 'min:0'],
            
            // Campos numéricos con valores por defecto
            'rooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            
            // Campos de ubicación
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],

            // Campo de servicios (Se analiza y se guarda como texto o JSON si es necesario)
            'services' => ['nullable', 'string', 'max:5000'],
            
            // Campo de periodo de precio: Lo mapearemos a id_tipo_estancia
            'pricePeriod' => [
                'required', 
                'string', 
                Rule::in(['daily', 'weekly', 'monthly'])
            ],
            // Los checkboxes de servicios adicionales ('facility', 'roomService', etc.)
            // se pueden validar si son obligatorios, pero por ahora los procesamos aparte.
        ]);

        // 2. Mapeo de datos del formulario a la base de datos

        // Paso 2.1: Obtener el id_tipo_estancia basado en el valor de 'pricePeriod'
        // NOTA: Debes implementar una tabla de mapeo (ej: 'daily' -> ID 1) para esto.
        // Simularemos el mapeo aquí.
        $tipoEstanciaId = $this->getTipoEstanciaId($request->input('pricePeriod'));
        
        // Paso 2.2: Procesar los servicios (textarea + checkboxes)
        $serviciosAdicionales = $this->processServices($request);
        
        // 3. Creación y almacenamiento de la propiedad
        try {
            $propiedad = Propiedad::create([
                'id_usuario' => Auth::id(), // Obtiene el ID del usuario autenticado
                'id_tipo_propiedad' => $request->input('accommodationType'),
                'id_tipo_estancia' => $tipoEstanciaId,
                
                'titulo' => $request->input('title'),
                'descripcion' => $request->input('description'),
                
                'precio_pesos' => $request->input('price'),
                
                'latitud' => $request->input('lat'),
                'longitud' => $request->input('lng'),
                
                'numero_habitaciones' => $request->input('rooms') ?? 0,
                'numero_baños' => $request->input('bathrooms') ?? 0,

                // Guardar los servicios procesados. Se recomienda JSON para estructurar los checkboxes.
                'servicios_incluye' => $serviciosAdicionales, 
            ]);

            // 4. Lógica para subir y asociar imágenes (No incluida aquí, pero necesaria)
            // ... $this->handleImageUpload($request, $propiedad);
            
            return redirect('/dashboard')->with('success', '¡Propiedad publicada exitosamente!');

        } catch (\Exception $e) {
            // Manejo de errores
            return back()->withInput()->with('error', 'Hubo un error al guardar la propiedad: ' . $e->getMessage());
        }
    }
    
    // --- Métodos Auxiliares ---

    /**
     * Mapea el periodo de precio (daily, monthly) al ID de la tabla tipos_estancia.
     * DEBES IMPLEMENTAR LA LÓGICA REAL (ej: consulta a la BD).
     */
    private function getTipoEstanciaId(string $period): int
    {
        // **ESTO ES UN MOCK. AJUSTA CON LA LÓGICA DE TU BD.**
        $map = [
            'daily' => 1,
            'weekly' => 2,
            'monthly' => 3,
        ];
        return $map[$period] ?? 1; // Devuelve 1 por defecto
    }

    /**
     * Combina el texto de servicios con los checkboxes seleccionados.
     * Se recomienda guardar como JSON para fácil deserialización.
     */
    private function processServices(Request $request): string
    {
        $data = [
            'texto_manual' => $request->input('services'),
            'instalaciones' => $request->input('facility', []),
            'servicios_habitacion' => $request->input('roomService', []),
            'tipo_grupo' => $request->input('groupType', []),
            'diversion' => $request->input('funType', []),
        ];

        return json_encode($data);
    }
    
    // Otros métodos (index, create, show, edit, update, destroy) van aquí...
}