<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1 class="text-2xl font-bold">Bienvenido</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="rounded bg-red-500 px-4 py-2 text-white text-sm font-medium hover:bg-red-600 transition">
            Cerrar sesión
        </button>
    </form>

</body>
</html>