<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades Formosa | {{ $title ?? 'Inicio' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
@livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
@vite(['resources/js/app.js'])
@vite(['resources/css/filters.css', 'resources/js/filters.js'])
</head>
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">


        
        {{-- 1. Logo y Título --}}
<a href="{{ route('info') }}" class="flex items-center space-x-2 rtl:space-x-reverse md:order-1">
    
    <svg class="h-8 w-8 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
    </svg>
    <span class="self-center text-xl font-bold tracking-tight whitespace-nowrap text-gray-900">Propiedades Formosa</span>
</a>

        {{-- 2. Botones de Autenticación (Derecha) --}}
        @if (Route::has('login'))
            <div class="flex items-center md:order-3 space-x-3 md:space-x-0 rtl:space-x-reverse justify-end gap-4">

                {{-- Clases de Estilo Comunes --}}
                @php
                    $baseClasses = 'inline-block px-4 py-2 text-sm font-medium leading-normal rounded-lg transition duration-200';
                    
                    // Botón principal (Iniciar Sesión / Register): Fondo Cyan
                    $primaryButton = 'bg-cyan-600 text-white hover:bg-cyan-700';
                    // Botón secundario (Dashboard / Publicar): Borde gris
                    $secondaryButton = 'text-gray-700 border border-gray-300 hover:bg-gray-100'; 
                @endphp

                @auth
                    {{-- DASHBOARD (SECUNDARIO) --}}
                    <a href="{{ url('/dashboard') }}" class="{{ $baseClasses }} {{ $secondaryButton }}">
                        Dashboard
                    </a>
                @else
                    {{-- LOGIN (PRINCIPAL) --}}
                    <a href="{{ route('login') }}" class="{{ $baseClasses }} {{ $primaryButton }}">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        {{-- REGISTER (SECUNDARIO) --}}
                        <a href="{{ route('register') }}" class="{{ $baseClasses }} {{ $secondaryButton }}">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        {{-- 3. Enlaces Centrales (Izquierda del Logo en móviles, Central en Desktop) --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-2" id="navbar-links">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                
                <li>
                    <a href="{{ route('inicio') }}"
                        class="block py-2 px-3 md:p-0 transition duration-150 rounded-lg 
                        {{-- ACTIVO: Cyan | INACTIVO: Gris con hover Cyan --}}
                        {{ request()->routeIs('inicio') ? 'text-cyan-600 font-semibold' : 'text-gray-700 hover:text-cyan-600' }}"
                        {{ request()->routeIs('inicio') ? 'aria-current="page"' : '' }}>
                        Inicio
                    </a>
                </li>
                
                <li>
                    <a href="#"
                        class="block py-2 px-3 md:p-0 transition duration-150 rounded-lg text-gray-700 hover:text-cyan-600">
                        Contacto
                    </a>
                </li>

                <li>
                    <a href="{{ route('info') }}"
                        class="block py-2 px-3 md:p-0 transition duration-150 rounded-lg 
                        {{-- ACTIVO: Cyan | INACTIVO: Gris con hover Cyan --}}
                        {{ request()->routeIs('info') ? 'text-cyan-600 font-semibold' : 'text-gray-700 hover:text-cyan-600' }}"
                        {{ request()->routeIs('info') ? 'aria-current="page"' : '' }}>
                        ¿Quiénes Somos?
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>