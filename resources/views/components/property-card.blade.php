@props(['propiedad'])

<div x-data="{ hover: false }"
     @mouseenter="hover = true"
     @mouseleave="hover = false"
     class="flex bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg">

    {{-- Imagen a la izquierda --}}
    <div class="w-64 h-full bg-gray-100 flex items-center justify-center overflow-hidden">
        @if($propiedad->imagen_url)
            <img src="{{ asset('storage/' . $propiedad->imagen_url) }}"
                 alt="Imagen de {{ $propiedad->titulo }}"
                 class="object-cover w-full h-full transition duration-300 hover:scale-105">
        @else
            <div class="text-gray-400 text-4xl">
                📷
            </div>
        @endif
    </div>

    {{-- Contenido a la derecha --}}
    <div class="flex-1 p-4 flex flex-col justify-between relative">
        <div>
            <h5 class="text-xl font-semibold text-gray-800">{{ $propiedad->titulo }}</h5>
            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($propiedad->descripcion, 80) }}</p>

            <div class="text-sm text-gray-500 space-y-1 mt-2">
                <p><strong>Tipo:</strong> {{ $propiedad->tipo->nombre ?? 'Sin tipo' }}</p>
                <p><strong>Publicado:</strong> {{ \Carbon\Carbon::parse($propiedad->fecha_publicacion)->format('d/m/Y') }}</p>
                <p><strong>Usuario:</strong> {{ $propiedad->usuario->nombre ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Botón oculto que aparece al hacer hover --}}
        <div x-show="hover"
             x-transition
             class="mt-4 text-right">
            <a href="{{ route('propiedades.show', $propiedad) }}"
               class="inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Ver más
            </a>
        </div>
    </div>
</div>