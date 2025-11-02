<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

</head>
<nav class="bg-gray-900 border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        {{-- 1. Logo y Título (Diseño Minimalista) --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-2 rtl:space-x-reverse md:order-1">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-xl font-bold tracking-tight whitespace-nowrap text-white">FormosaZone</span>
        </a>

        {{-- 2. Botones de Autenticación (Derecha) --}}
        @if (Route::has('login'))
            <div class="flex items-center md:order-3 space-x-3 md:space-x-0 rtl:space-x-reverse justify-end gap-4">

                {{-- Clases de Estilo Comunes (Gris por defecto -> Azul en hover) --}}
                @php
                    $baseClasses =
                        'inline-block px-4 py-2 text-sm font-medium leading-normal rounded-lg transition duration-200';
                    $defaultStyle = 'text-white border border-gray-600 hover:text-white'; // Borde gris más oscuro
                    $hoverEffect =
                        'hover:bg-gradient-to-br hover:from-cyan-500 hover:to-blue-500 hover:border-transparent hover:shadow-lg hover:shadow-cyan-500/50';
                @endphp

                @auth
                    {{-- DASHBOARD --}}
                    <a href="{{ url('/dashboard') }}" class="{{ $baseClasses }} {{ $defaultStyle }} {{ $hoverEffect }}">
                        Dashboard
                    </a>
                @else
                    {{-- LOGIN --}}
                    <a href="{{ route('login') }}" class="{{ $baseClasses }} {{ $defaultStyle }} {{ $hoverEffect }}">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        {{-- REGISTER --}}
                        <a href="{{ route('register') }}"
                           class="{{ $baseClasses }} {{ $defaultStyle }} {{ $hoverEffect }}">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        {{-- 3. Enlaces Centrales (Izquierda del Logo en móviles, Central en Desktop) --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-2" id="navbar-links">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 text-indigo-400 rounded-lg md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded-lg hover:text-indigo-400 md:p-0 transition duration-150">
                        Buscar propiedades
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 text-white rounded-lg hover:text-indigo-400 md:p-0 transition duration-150">
                        Contacto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
