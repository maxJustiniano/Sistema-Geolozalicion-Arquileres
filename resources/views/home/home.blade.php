@extends('components.navbar')

@section('content')
    <!-- Listado de propiedades -->
        <main class="flex-1 p-6">
            <h4 class="text-2xl font-bold mb-6">Propiedades disponibles</h4>

            <div class="flex flex-col gap-6">
                @forelse($propiedades as $propiedad)
                    <x-property-card :propiedad="$propiedad" />
                @empty
                    <p class="text-gray-500">No se encontraron propiedades.</p>
                @endforelse
            </div>
        </main>
</div>
@endsection