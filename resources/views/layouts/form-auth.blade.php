<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'FormAuth')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-900">

    <div class="min-h-screen flex flex-col sm:justify-center items-center">

        {{-- Logo con separación de 10px del body --}}
        <div class="mt-2.5">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="logo" class="w-16 h-16">
        </div>

        {{-- Formulario con separación de 20px del body --}}
        <div class="w-full sm:max-w-md mt-5 px-6 py-8 bg-gray-800 shadow-xl rounded-2xl border border-gray-800">
            @yield('content')
        </div>

    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
