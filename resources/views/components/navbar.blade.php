<!DOCTYPE html>
<html lang="es" x-data x-init="$nextTick(() => Alpine.start())">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormosaZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewire('property-filters')
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar propia -->
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">FormosaZone</a>
            <div class="space-x-4">
                <a href="#" class="hover:underline">Inicio</a>
                <a href="#" class="hover:underline">Mapa</a>
                <a href="#" class="hover:underline">Contacto</a>
                <a href="#" class="hover:underline">Iniciar Sesion</a>
            </div>
        </div>
    </nav>

    
    <!-- Contenido principal -->
    <div class="flex max-w-7xl mx-auto mt-6">
        <!-- Sidebar filtros -->
        <aside 
    x-data="{ open: true }" 
    class="w-72 bg-white shadow-lg rounded-xl border border-gray-200 p-5 space-y-6 text-sm transition-all duration-300"
>
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-blue-600 flex items-center gap-2">
            <i class="fas fa-filter"></i> Filtros Avanzados
        </h2>
        <!-- Botón colapsar -->
        <button @click="open = !open" class="text-gray-500 hover:text-blue-600 transition">
            <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
        </button>
    </div>

    <!-- Contenido -->
    <div x-show="open" x-transition class="space-y-6">
        <!-- Tipo de propiedad -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-home text-blue-500"></i> Tipo de Propiedad
            </label>
            <select name="propertyType" 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">Todas</option>
                <option value="casa">Casa</option>
                <option value="departamento">Departamento</option>
                <option value="terreno">Terreno</option>
            </select>
        </div>

        <!-- Barrio -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-map-marker-alt text-red-500"></i> Barrio
            </label>
            <input type="text" name="neighborhood" placeholder="Ej: Centro, San Martín..."
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Habitaciones -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-bed text-purple-500"></i> Habitaciones (mín)
            </label>
            <input type="number" name="minRooms" min="0" max="10" value="0"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Baños -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-bath text-indigo-500"></i> Baños (mín)
            </label>
            <input type="number" name="minBathrooms" min="0" max="5" value="0"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Rango de precios -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-dollar-sign text-green-500"></i> Rango de Precios (ARS)
            </label>
            <div class="space-y-2">
                <input type="range" name="minPrice" min="3000000" max="12000000" value="3000000" class="w-full accent-blue-600">
                <input type="range" name="maxPrice" min="3000000" max="12000000" value="12000000" class="w-full accent-blue-600">
                <div class="text-gray-600 text-xs font-medium">3.000.000 - 12.000.000 ARS</div>
            </div>
        </div>

        <!-- Características -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-star text-yellow-500"></i> Características
            </label>
            <div class="space-y-1 pl-2 text-gray-600">
                <label class="flex items-center gap-2"><input type="checkbox" name="hasPatio" class="accent-blue-600"> <i class="fas fa-tree"></i> Patio</label>
                <label class="flex items-center gap-2"><input type="checkbox" name="hasAmueblado" class="accent-blue-600"> <i class="fas fa-couch"></i> Amueblado</label>
                <label class="flex items-center gap-2"><input type="checkbox" name="hasParking" class="accent-blue-600"> <i class="fas fa-car"></i> Estacionamiento</label>
                <label class="flex items-center gap-2"><input type="checkbox" name="hasPool" class="accent-blue-600"> <i class="fas fa-swimming-pool"></i> Pileta</label>
                <label class="flex items-center gap-2"><input type="checkbox" name="petsAllowed" class="accent-blue-600"> <i class="fas fa-paw"></i> Mascotas</label>
            </div>
        </div>

        <!-- Lugar de referencia -->
        <div class="space-y-2">
            <label class="font-medium flex items-center gap-2 text-gray-700">
                <i class="fas fa-landmark text-pink-500"></i> Lugar de Referencia
            </label>
            <input type="text" name="referencePlace" placeholder="Ej: cerca de Plaza San Martín..."
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
        </div>

        <!-- Botones -->
        <div class="flex flex-col gap-2 pt-4">
            <button type="submit" class="bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
                <i class="fas fa-search"></i> Aplicar Filtros
            </button>
            <button type="reset" class="bg-gray-200 text-gray-800 py-2 rounded-md hover:bg-gray-300 transition flex items-center justify-center gap-2">
                <i class="fas fa-times"></i> Limpiar
            </button>
        </div>
    </div>
</aside>

       @yield('content')

    </div>
@livewireScripts

</body>
</html>