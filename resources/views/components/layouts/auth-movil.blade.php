<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Usamos $title si se pasa, sino el predeterminado --}}
    <title>{{ $title ?? 'Propia - Login & Registro' }}</title> 
    
    {{-- Tus scripts y CSS --}}
    <script src="/_sdk/element_sdk.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/css/login-register.css') }}">
    
    {{-- Incluye tu cabecera parcial --}}
    @include('partials.head')

</head>

{{-- Body con tu fondo custom --}}
<body class="bg-gradient-custom min-h-full">
    <main class="min-h-full flex items-center justify-center p-4">
        
        {{-- 
            NUEVO CONTENEDOR PRINCIPAL: 
            En móvil: se ignora el flex/grid. 
            En escritorio (lg): 
            1. Ancho máximo: max-w-2xl (un poco más grande que max-w-md)
            2. Display: flex
            3. Min-h: altura mínima para Split Screen
        --}}
        <div class="w-full max-w-md lg:max-w-4xl lg:flex lg:items-center lg:min-h-[500px]">

            <div class="bg-card-custom rounded-xl card-shadow overflow-hidden w-full lg:flex lg:w-full">
                
                {{-- 
                    PANEL DE IMAGEN (Split Panel)
                    - w-full h-56: Altura completa en móvil.
                    - lg:w-1/3 lg:h-auto: **OCUPA SOLO 1/3 DEL ANCHO** en escritorio.
                    - lg:flex: Permite centrar el contenido de la imagen en escritorio.
                    - hidden lg:block: Oculta la imagen en móvil para usar el div del formulario.
                    - NOTA: He cambiado la posición de este div para que aparezca a la izquierda en escritorio.
                --}}
                <div class="relative hidden lg:block lg:w-1/2 lg:h-auto bg-cover bg-center"
                    style="background-image: url('{{ asset('build/assets/img/icono-auth.jpeg') }}');">
                    
                    {{-- Overlay y contenido de la imagen (mantener blanco en el Split) --}}
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-6">
                        <div class="mb-4">
                            <div class="inline-flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-custom rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">P</span>
                                </div>
                                <span class="text-xl font-semibold">Propia</span>
                            </div>
                        </div>
                        <h2 class="text-2xl font-semibold mb-3">Bienvenido a </h2>
                        <p class="text-sm opacity-90 leading-relaxed">Una plataforma moderna y confiable para gestionar propiedades de manera simple y segura.</p>
                    </div>
                </div>

                {{-- 
                    PANEL DEL FORMULARIO (Se muestra en móvil y escritorio)
                    - w-full: Ocupa el 100% del ancho del padre en móvil.
                    - lg:w-2/3: **OCUPA LOS 2/3 RESTANTES** en escritorio.
                    - lg:p-10: Añade más padding para mejor visualización en Split.
                --}}
                <div class="w-full lg:w-2/3">

                    {{-- 
                        CABECERA/IMAGEN EN MÓVIL (Versión apilada)
                        Este es el DIV que quieres mantener para móvil
                        y ocultar en escritorio.
                    --}}
                    <div class="relative h-56 bg-cover bg-center lg:hidden" 
                        style="background-image: url('{{ asset('build/assets/img/icono-auth.jpeg') }}');">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div
                            class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-6">
                            <div class="mb-4">
                                <div class="inline-flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-blue-custom rounded-lg flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">P</span>
                                    </div>
                                    <span class="text-xl font-semibold">Propia</span>
                                </div>
                            </div>
                            <h2 class="text-2xl font-semibold mb-3">Bienvenido a Propia</h2>
                            <p class="text-sm opacity-90 leading-relaxed">Una plataforma moderna y confiable para
                                gestionar propiedades de manera simple y segura.</p>
                        </div>
                    </div>


                    {{-- PUNTO DE INSERCIÓN DEL CONTENIDO (EL FORMULARIO) --}}
                    <div class="p-8 lg:p-10">
                        {{ $slot }} 
                    </div>

                </div>
            </div>
        </div>
    </main>
    {{-- Scripts de Livewire/Flux --}}
    @fluxScripts
    
</body>

</html>