@props([
    'action',
    'method',
    'routeIndex'
])

{{-- Contenedor principal para que el formulario se parezca al contenedor de la tabla --}}
<div class="bg-white dark:bg-zinc-800 border border-neutral-200 dark:border-neutral-700 rounded-xl shadow-lg p-8 space-y-6 max-w-lg mx-auto">
    
    <form action="{{ $action }}" method="POST">
        @csrf
        @method($method)

        {{-- Contenido del formulario (label/input) --}}
        {{$slot}}

        <div class="mt-8 flex justify-end space-x-3">
            
            {{-- Botón Cancelar (Estilo secundario/bordeado) --}}
            <a href="{{ route($routeIndex) }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-neutral-300 dark:border-neutral-600 text-sm font-medium rounded-lg text-neutral-700 dark:text-neutral-300 bg-white dark:bg-zinc-800 hover:bg-neutral-50 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition-colors">
                Cancelar
            </a>

            {{-- Botón Confirmar (Estilo primario/azul) --}}
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition-colors">
                Confirmar
            </button>
        </div>
    </form>
</div>