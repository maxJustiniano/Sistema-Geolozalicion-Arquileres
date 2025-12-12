@props(['property'])

<div 
    class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-lg shadow-md md:max-w-3xl w-full hover:shadow-lg transition duration-300 dark:border-gray-700 dark:bg-gray-800">
    
    {{-- BLOQUE DE IMAGEN --}}
    @if ($property->imagenes->isNotEmpty())
        <div class="md:w-1/3 w-full h-64 md:h-auto flex-shrink-0">
            <img class="object-cover w-full h-full rounded-t-lg md:rounded-l-lg md:rounded-t-none" 
                 src="{{ $property->imagenes->first()->url_imagen }}" 
                 alt="{{ $property->titulo }}">
        </div>
    @else
        {{-- Imagen de Placeholder --}}
        <div class="md:w-1/3 w-full h-64 md:h-auto bg-gray-300 flex items-center justify-center rounded-t-lg md:rounded-l-lg md:rounded-t-none text-gray-500 flex-shrink-0">
            [Sin Imagen]
        </div>
    @endif
    
    {{-- BLOQUE DE CONTENIDO --}}
    <div class="flex flex-col justify-between leading-normal w-full md:w-2/3 p-4">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $property->titulo }}
            </h5>
            <p class="mb-4 font-normal text-gray-700 dark:text-gray-400 line-clamp-3">
                {{ $property->descripcion }}
            </p>
        </div>

        <div class="flex flex-row space-x-3 mt-4 justify-end">
            {{-- Botón Ver Alquiler (Secundario - AHORA ES UN ENLACE <a>) --}}
            {{-- Botón Ver Alquiler (Secundario) --}}
<a href="{{ route('inmueble.show', $property) }}"
   class="inline-flex items-center px-4 py-2 text-sm font-medium text-center 
          text-gray-700 bg-gray-100 rounded-lg 
          hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 
          dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
    Ver Propiedad
</a>
            

        </div>
    </div>
</div>