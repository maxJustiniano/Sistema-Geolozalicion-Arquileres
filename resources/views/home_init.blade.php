<x-layouts.app.navbar />

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:space-x-8">

<div class="md:w-1/4 md:flex-shrink-0">
        <x-layouts.app.filters /> 
    </div>

<main class="flex-grow">
            
            {{-- LLAMADA AL COMPONENTE DE BÚSQUEDA --}}
            <div class="mb-8 max-w-3xl mx-auto">
                @livewire('search') 
            </div>

            {{-- Contenido de las Propiedades --}}
            <div class="space-y-6 mb-8 max-w-3xl mx-auto">
                @livewire('propiedades') 
            </div>
        </main>

          </div>
</div>
<x-layouts.app.footer />