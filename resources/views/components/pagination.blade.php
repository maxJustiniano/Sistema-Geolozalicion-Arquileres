{{-- resources/views/components/layouts/pagination.blade.php --}}
@if ($paginator->hasPages())
<nav class="flex justify-center mt-8">
    <div class="flex">

        {{-- Botón Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="flex items-center justify-center px-4 py-2 mx-1 text-gray-500 capitalize bg-white rounded-md cursor-not-allowed rtl:-scale-x-100 dark:bg-gray-800 dark:text-gray-600">
                {{-- SVG para la flecha izquierda --}}
            </span>
        @else
            <a wire:click="previousPage" href="#" class="flex items-center justify-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md rtl:-scale-x-100 dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                 {{-- SVG para la flecha izquierda --}}
            </a>
        @endif

        {{-- ✅ Lógica para Números y Puntos Suspensivos --}}
        @foreach ($elements as $element)
            
            {{-- Puntos Suspensivos (String '...') --}}
            @if (is_string($element))
                <span class="hidden px-4 py-2 mx-1 text-gray-700 capitalize bg-white rounded-md sm:inline dark:bg-gray-800 dark:text-gray-200 cursor-default">
                    {{ $element }}
                </span>
            @endif

            {{-- Enlaces Numéricos (Array) --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- Página Activa --}}
                        <a wire:click="gotoPage({{ $page }})" href="#" class="hidden px-4 py-2 mx-1 text-white transition-colors duration-300 transform bg-blue-500 rounded-md sm:inline dark:bg-blue-500 dark:text-white">
                            {{ $page }}
                        </a>
                    @else
                        {{-- Otras Páginas --}}
                        <a wire:click="gotoPage({{ $page }})" href="#" class="hidden px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md sm:inline dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($paginator->hasMorePages())
            <a wire:click="nextPage" href="#" class="flex items-center justify-center px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md rtl:-scale-x-100 dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                {{-- SVG para la flecha derecha --}}
            </a>
        @else
            <span class="flex items-center justify-center px-4 py-2 mx-1 text-gray-500 capitalize bg-white rounded-md cursor-not-allowed rtl:-scale-x-100 dark:bg-gray-800 dark:text-gray-600">
                {{-- SVG para la flecha derecha --}}
            </span>
        @endif
        
    </div>
</nav>
@endif