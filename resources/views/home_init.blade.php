<x-layouts.app.navbar />
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 dark:text-white">Alquileres disponibles</h1>

    <div class="space-y-6">
        @livewire('propiedades') 
    </div>

    
</div>
<x-layouts.app.footer />