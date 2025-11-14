<x-layouts.app.navbar />

<section
    class="bg-center bg-no-repeat bg-cover bg-gray-700 bg-blend-multiply" {{-- Agregado bg-cover y bg-gray-700 bg-blend-multiply --}}
    style="background-image: url('{{ Vite::asset('resources/img/una-imagen-de-mapa.jpeg') }}');">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Bienvenido al sistema de Geolocalizacion
            de Formosa Capital
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Encuentra y alquila propiedades
            fácilmente filtrando por ubicación, precio y características para descubrir el lugar perfecto para vivir.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="#"
                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Ver Alquileres
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
            <a href="#"
                class="inline-flex justify-center items-center py-3 px-5 sm:ms-4 text-base font-medium text-center rounded-lg border
                       text-white border-white hover:bg-white hover:text-gray-900 focus:ring-4 focus:ring-gray-400"> {{-- Ajustes aquí para el contraste --}}
                Publicar Propiedad
            </a>
        </div>
    </div>
</section>

<div class="bg-gray-900 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base/7 font-semibold text-indigo-400">ENCUENTRA TU ESPACIO IDEAL</h2>
            <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-white sm:text-5xl lg:text-balance">
                Descubre la forma más inteligente de buscar y publicar alquileres</p>
            <p class="mt-6 text-lg/8 text-gray-300">Nuestra plataforma fusiona la precisión de la geolocalización con
                herramientas de filtrado avanzadas para que cada búsqueda te acerque a tu hogar ideal.</p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">

                <div class="relative pl-16">
                    <dt class="text-base/7 font-semibold text-white">
                        <div
                            class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        Búsqueda Visual en Mapa
                    </dt>
                    <dd class="mt-2 text-base/7 text-gray-400">Mira exactamente dónde se ubica cada alquiler. Reduce el
                        tiempo de búsqueda filtrando por barrios o puntos de interés cercanos.</dd>
                </div>

                <div class="relative pl-16">
                    <dt class="text-base/7 font-semibold text-white">
                        <div
                            class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                data-slot="icon" aria-hidden="true" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                        </div>
                        Filtros Inteligentes
                    </dt>
                    <dd class="mt-2 text-base/7 text-gray-400">Encuentra coincidencias exactas por precio, superficie,
                        número de habitaciones y amenidades, sin ver propiedades irrelevantes.</dd>
                </div>


                <div class="relative pl-16">
                    <dt class="text-base/7 font-semibold text-white">
                        <div
                            class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        Contacto Rápido y Seguro
                    </dt>
                    <dd class="mt-2 text-base/7 text-gray-400">Comunícate directamente con propietarios verificados.
                        Envía consultas y coordina visitas de manera eficiente y protegida.</dd>
                </div>

                <div class="relative pl-16">
                    <dt class="text-base/7 font-semibold text-white">
                        <div
                            class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                        </div>
                        Gestión de Propiedades
                    </dt>
                    <dd class="mt-2 text-base/7 text-gray-400">Si eres propietario, publica, edita y gestiona todos tus
                        anuncios de alquiler fácilmente desde un único panel intuitivo.</dd>
                </div>

            </dl>
        </div>
    </div>
</div>


<x-layouts.app.footer />