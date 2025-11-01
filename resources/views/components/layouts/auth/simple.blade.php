<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Usamos $title si se pasa, sino el predeterminado --}}
    <title>{{ $title ?? 'Propia - Login & Registro' }}</title> 
    
    {{-- Tus scripts y CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/auth.css'])
    
    {{-- Incluye tu cabecera parcial --}}
    @include('partials.head')

</head>

{{-- Body con tu fondo custom --}}
<body class="bg-gradient-custom min-h-full">
    <main class="min-h-full flex items-center justify-center p-4">
        

        <div class="w-full max-w-md lg:max-w-4xl lg:flex lg:items-center lg:min-h-[500px]">

            <div class="bg-card-custom rounded-xl card-shadow overflow-hidden w-full lg:flex lg:w-full">
                
                <div class="relative hidden lg:block lg:w-1/2 lg:h-auto bg-cover bg-center"
                    style="background-image: url('{{ Vite::asset('resources/img/ejem-sistem-auth.jpeg') }}');">
                    
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


                <div class="w-full lg:w-2/3">


                    <div class="relative h-56 bg-cover bg-center lg:hidden" 
                        style="background-image: url('{{ Vite::asset('resources/img/ejem-sistem-auth.jpeg') }}');">
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