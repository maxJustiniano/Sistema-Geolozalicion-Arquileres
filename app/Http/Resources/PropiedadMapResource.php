<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropiedadMapResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Cargamos los filtros en memoria para clasificarlos
        $filtros = $this->filtros;

        // Lógica para obtener la URL de la primera imagen
        $firstImage = $this->imagenes->first();
        $imageUrl = $firstImage ? asset($firstImage->url_imagen) : asset('');
        // Usamos asset() para generar la URL completa con el dominio.
        

        return [
            'id' => $this->id,
            // Obtenemos el slug de la tabla relacionada (ej: 'casa')
            'type' => $this->tipoPropiedad->slug ?? 'casa', 
            'accommodationType' => $this->tipoEstancia->slug ?? 'alquiler', 
            'neighborhood' => $this->barrio, // Asegúrate de tener esta columna en BD
            'rooms' => $this->numero_habitaciones,
            'bathrooms' => $this->numero_baños,
            'price' => (int) $this->precio_pesos,

            //Imagen
            'imageUrl' => $imageUrl,
            'allImages' => $this->whenLoaded('imagenes', function () {
                return $this->imagenes->map(function ($imagen) {
                    return asset($imagen->url_imagen);
                })->toArray();
            }),

            // Booleanos directos de tu tabla
            'hasPatio' => (bool) $this->tiene_patio,
            'hasAmueblado' => (bool) $this->amueblado,
            'hasParking' => (bool) $this->tiene_parking,
            
            // Calculados dinámicamente según si existen los filtros específicos
            'hasPool' => $filtros->contains('slug', 'piscina'),
            'petsAllowed' => $filtros->contains('slug', 'admite_mascotas'),

            // Coordenadas (mapeo de nombres: latitud -> lat)
            'lat' => (float) $this->latitud,
            'lng' => (float) $this->longitud,
            
            'reference' => $this->referencia_ubicacion ?? '',
            'description' => $this->descripcion,

            // Aquí separamos los filtros en los arrays que pide tu JS
            // Pluck('slug') extrae solo el texto: ['wifi', 'parking']
            'facility' => $filtros->where('categoria', 'facility')->pluck('slug')->values(),
            'roomService' => $filtros->where('categoria', 'roomService')->pluck('slug')->values(),
            'groupType' => $filtros->where('categoria', 'groupType')->pluck('slug')->values(),
        ];
    }
}