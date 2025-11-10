<div class="space-y-6">
    
    @forelse ($Propiedades as $property)
        
        <x-property-card :property="$property" /> 
        
        
    @empty
        <p class="text-center text-gray-500 dark:text-gray-400">
            No hay propiedades disponibles en este momento.
        </p>
    @endforelse

    <div class="mt-8">
        {{ $Propiedades->links() }}
    </div>
</div>