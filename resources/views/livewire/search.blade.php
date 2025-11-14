<form>
    <label for="search" class="sr-only">Buscar Propiedades</label>
    <div class="relative">
        {{-- Ícono de Búsqueda --}}
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        
        {{-- Input de Texto (CLAVE: wire:model.live="search" para este componente) --}}
        <input 
            type="search" 
            id="search" 
            wire:model.live="search" 
            class="block w-full p-3 ps-10 
                    bg-white dark:bg-gray-800 
                    border border-gray-300 dark:border-gray-700 
                    text-gray-900 dark:text-white 
                    text-sm rounded-lg shadow-sm
                    focus:ring-blue-500 focus:border-blue-500 
                    placeholder:text-gray-500 dark:placeholder:text-gray-400" 
            placeholder="Buscar por título, descripción o ubicación..." 
            required 
        />
        {{-- Quitamos el botón de buscar ya que la búsqueda se hace en tiempo real (wire:model.live) --}}
    </div>
</form>