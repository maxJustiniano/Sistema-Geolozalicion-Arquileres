<x-layouts.app :title="__('Dashboard')">

    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- GRID PARA 3 MÉTRICAS (md:2 columnas, lg:3 columnas) -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 lg:grid-cols-3">

            <!-- CARD 1: PROPIEDADES (Icono: Edificio/Casa) -->
            <a href="#"
                class="group block cursor-pointer metric-card bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200
                        dark:border-gray-700 w-full transition duration-300 ease-in-out
                        hover:shadow-2xl hover:border-blue-500 dark:hover:border-blue-400">
                <div class="p-5 md:p-6">
                    <div class="flex items-center h-28">
                        <div class="flex-1 pr-4" style="flex: 0 0 70%;">
                            <p id="metric-title-1"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1 transition duration-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Propiedades Activas
                            </p>
                            <div class="flex items-center justify-start">
                                <span id="metric-value-1"
                                    class="text-5xl font-bold text-gray-900 dark:text-white leading-none transition duration-300">
                                    247
                                </span>
                            </div>
                            <p id="metric-description-1" class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                Total de unidades disponibles
                            </p>
                        </div>

                        <div class="flex items-center justify-center h-full" style="flex: 0 0 30%;">
                            <div
                                class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center transition duration-300 group-hover:scale-110">
                                <!-- Icono de Edificio/Casa (Aumentado a w-10 h-10) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-blue-600 dark:text-blue-400 transition duration-300 group-hover:text-blue-700 dark:group-hover:text-blue-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>

                            </div>
                        </div>
                    </div>


                </div>

            </a>

            <!-- CARD 2: USUARIOS (Icono: Usuario - Azul) -->
            <a href="#"
                class="group block cursor-pointer metric-card bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200
                    dark:border-gray-700 w-full transition duration-300 ease-in-out
                    hover:shadow-2xl hover:border-blue-500 dark:hover:border-blue-400">

                <div class="p-5 md:p-6">
                    <div class="flex items-center h-28">
                        <div class="flex-1 pr-4" style="flex: 0 0 70%;">
                            <p id="metric-title-2"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1 transition duration-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Usuarios Registrados
                            </p>
                            <div class="flex items-center justify-start">
                                <span id="metric-value-2"
                                    class="text-5xl font-bold text-gray-900 dark:text-white leading-none transition duration-300">
                                    8.5K
                                </span>
                            </div>
                            <p id="metric-description-2" class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                Clientes y prospectos totales
                            </p>
                        </div>

                        <div class="flex items-center justify-center h-full" style="flex: 0 0 30%;">
                            <div
                                class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center transition duration-300 group-hover:scale-110">
                                <!-- Icono de Usuario (Aumentado a w-10 h-10, cambiado a azul) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-blue-600 dark:text-blue-400 transition duration-300 group-hover:text-blue-700 dark:group-hover:text-blue-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>


                </div>

            </a>

            <!-- CARD 3: MAPA (Icono: Mapa - Azul) -->
            <a href="#"
                class="group block cursor-pointer metric-card bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200
                    dark:border-gray-700 w-full transition duration-300 ease-in-out
                    hover:shadow-2xl hover:border-blue-500 dark:hover:border-blue-400">

                <div class="p-5 md:p-6">
                    <div class="flex flex-col items-center justify-center h-28 text-center">

                        <div class="flex items-center justify-center mb-2" style="flex: 0 0 30%;">
                            <div
                                class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center transition duration-300 group-hover:scale-110">
                                <!-- Icono de Mapa (Aumentado a w-10 h-10, cambiado a azul) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-blue-600 dark:text-blue-400 transition duration-300 group-hover:text-blue-700 dark:group-hover:text-blue-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex-1 w-full mt-2">
                            <p id="metric-title-3"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1 transition duration-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Mapa de Propiedades
                            </p>
                            <p id="metric-description-3" class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                Localiza y explora propiedades
                            </p>
                        </div>

                    </div>


                </div>

            </a>

        </div>

        <!-- ÁREA DE CONTENIDO PRINCIPAL (GRÁFICAS / TABLAS) -->
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <!-- Placeholder para la gráfica/tabla principal -->
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>

    </div>


</x-layouts.app>
