<x-layouts.app :title="__('Propiedades')">


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <main>
        {{-- Usar un contenedor para centrar y aplicar padding --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">

            <div
                class="bg-white dark:bg-zinc-800 border border-neutral-200 dark:border-neutral-700 rounded-xl shadow-sm overflow-hidden">


                <div class="px-6 py-5 border-b border-neutral-200 dark:border-neutral-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 id="tableTitle" class="text-xl font-semibold text-neutral-900 dark:text-white">
                                Gestión de Propiedades
                            </h2>
                            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                                Gestiona los datos de Propiedades
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            {{-- Botón 'Ver Todos' omitido ya que no hay barra de búsqueda para resetear --}}
                            
                            {{-- Botón 'Agregar Nuevo' --}}
                            <a href="{{ route('propiedades.create') }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                                    </path>
                                </svg>
                                Crear Nueva Propiedad
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Mensajes de Sesión con el estilo Tailwind de tu componente original --}}
                @if (session('success'))
                    <div class="m-4 rounded-lg bg-green-100 p-4 text-sm text-green-700 dark:bg-green-900/50 dark:text-green-300"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="m-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-900/50 dark:text-red-300"
                        role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- APLICACIÓN DE LA SOLUCIÓN: Usar overflow-x-auto aquí --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                        <thead class="bg-neutral-50 dark:bg-zinc-800/50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Título</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Propietario</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Tipo Propiedad</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Tipo Estancia</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Precio</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Barrio</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    Imágenes</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider whitespace-nowrap">
                                    <span>Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse ($propiedades as $propiedad)
                                <tr class="hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors">
                                    {{-- ID --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->id }}
                                        </div>
                                    </td>
                                    {{-- Título --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->titulo }}
                                        </div>
                                    </td>

                                    {{-- Propietario --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->user->name ?? 'N/A' }}
                                        </div>
                                    </td>

                                    {{-- Tipo Propiedad --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->tipoPropiedad->nombre ?? 'N/A' }}
                                        </div>
                                    </td>
                                    {{-- Tipo Estancia --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->tipoEstancia->nombre ?? 'N/A' }}
                                        </div>
                                    </td>
                                    {{-- Precio --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            $ {{ number_format($propiedad->precio_pesos, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    {{-- Barrio --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->barrio }}
                                        </div>
                                    </td>

                                    {{-- Imágenes --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white ">
                                            {{ $propiedad->imagenes->count() }}
                                        </div>
                                    </td>

                                    {{-- Acciones --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('propiedades.edit', $propiedad) }}"
                                                class="text-neutral-400 hover:text-blue-500 dark:text-neutral-500 dark:hover:text-blue-400 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            {{-- Botón Eliminar --}}
                                            <form action="{{ route('propiedades.destroy', $propiedad) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que quieres eliminar este registro?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-1 leading-none text-neutral-400 hover:text-red-500 dark:text-neutral-500 dark:hover:text-red-400 transition-colors bg-transparent border-none focus:outline-none">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">
                                        No hay propiedades cargadas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
                    {{ $propiedades->links() }}
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>