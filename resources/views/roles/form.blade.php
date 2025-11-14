<x-layouts.app :title="__('Tipos de Usuarios')">
    <main class="py-6 px-4 sm:px-6 lg:px-8 w-full h-full">
        <x-form :action="$action" :method="$method" 
            :routeIndex="$routeIndex">

            <label for="nombre_rol" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                Nombre del Rol 
            </label>
            
            <input type="text" 
                   name="nombre_rol" 
                   id="nombre_rol" 
                   value="{{$rol->nombre_rol ?? ''}}"
                   {{-- CLASES DE ESTILO DEL INPUT --}}
                   class="block w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg 
                          bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white 
                          placeholder-neutral-500 dark:placeholder-neutral-400 
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors">
                          
        </x-form>
    </main>
</x-layouts.app>