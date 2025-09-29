<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', 'Panel de Administración')</title>

    <!-- Fuente personalizada -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

    <style>
        /* Estilo extra para que las tablas luzcan mejor */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
        }
        thead tr {
            background-color: #1e40af; /* azul oscuro */
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f3f4f6; /* gris claro */
        }
        tbody tr:hover {
            background-color: #e0e7ff; /* azul claro */
        }
        th {
            border-bottom: 2px solid #3b82f6;
        }
        td {
            border-bottom: 1px solid #d1d5db;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">

    <header class="bg-blue-800 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-semibold">Panel de Administración</h1>
            <nav>
                
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>

    <footer class="mt-12 p-4 bg-gray-200 text-center text-gray-600">
        &copy; {{ date('Y') }} - Aplicación de Propiedades
    </footer>

</body>
</html>
