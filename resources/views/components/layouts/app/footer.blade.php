<main class="flex-grow">
<footer class="p-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            
            <div class="mb-6 md:mb-0">
                <a href="#" class="flex items-center">
                    {{-- Logo: Texto gris en claro, blanco en oscuro --}}
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900 dark:text-white">Propiedades Formosa</span>
                </a>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-xs">
                    ¡El lugar perfecto para encontrar tu alquiler deseado!
                </p>
            </div>
            
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                
                <div>
                    {{-- Título de sección: Gris oscuro en claro, blanco en oscuro --}}
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Recursos</h2>
                    <ul class="text-gray-500 dark:text-gray-400 space-y-4">
                        {{-- Enlaces: Hover en Cyan --}}
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Documentación</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">GitHub</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Tutoriales</a></li>
                    </ul>
                </div>
                
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Compañía</h2>
                    <ul class="text-gray-500 dark:text-gray-400 space-y-4">
                        {{-- Enlaces: Hover en Cyan --}}
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Acerca de</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Blog</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Contacto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 space-y-4">
                        {{-- Enlaces: Hover en Cyan --}}
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Política de Privacidad</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-cyan-600 dark:hover:text-cyan-400">Licencias</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <hr class="my-6 border-gray-200 dark:border-gray-700 sm:mx-auto lg:my-8" />
        
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                {{-- Marca: Hover en Cyan --}}
                © {{ date('Y') }} <a href="#" class="hover:underline hover:text-cyan-600 dark:hover:text-cyan-400"></a>. Todos los derechos reservados.
            </span>
            </div>
    </div>
</footer>

@livewireScripts

</body>
</head>

