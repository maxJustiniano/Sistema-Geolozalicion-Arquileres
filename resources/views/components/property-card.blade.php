@props(['property'])

{{-- 
    CONTENEDOR PRINCIPAL MODIFICADO
    - Cambiamos el ancho máximo a md:max-w-3xl
--}}
<div 
    class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-lg shadow-md md:max-w-3xl w-full hover:shadow-lg transition duration-300 dark:border-gray-700 dark:bg-gray-800 p-4">

    <div class="flex flex-col justify-between leading-normal w-full">

        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $property->titulo }}
            </h5>
            <p class="mb-4 font-normal text-gray-700 dark:text-gray-400 line-clamp-3">
                {{ $property->descripcion }}
            </p>
        </div>

        <div class="flex flex-row space-x-3 mt-4 justify-end">

            {{-- Botón Ver Alquiler --}}
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                Ver Alquiler
            </button>

            {{-- Botón Reservar --}}
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Reservar
            </button>
        </div>
    </div>
</div>