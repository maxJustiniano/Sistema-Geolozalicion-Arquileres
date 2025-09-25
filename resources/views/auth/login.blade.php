@extends('layouts.form-auth')

@section('title', 'Login')

@section('content')

    <h1 class="text-3xl font-bold mb-6 text-center text-white">Iniciar sesión</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="text-sm text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Correo --}}
        <div>
            <label for="email" class="block font-medium text-sm text-gray-200">Correo electrónico</label>
            <input
                class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="ejemplo@correo.com"
                required
                autofocus
                autocomplete="username"
            />
        </div>

        {{-- Contraseña --}}
        <div>
            <label for="password" class="block font-medium text-sm text-gray-200">Contraseña</label>
            <input
                class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                autocomplete="current-password"
            />
        </div>

        {{-- Botón --}}
        <div>
            <button
                type="submit"
                class="w-full py-3 rounded-lg bg-blue-600 hover:bg-blue-700 transition font-semibold text-white tracking-wide shadow-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
                Ingresar
            </button>
        </div>
    </form>

    {{-- Register link --}}
    <p class="mt-6 text-center text-sm text-gray-400">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium">Regístrate aquí</a>
    </p>

@endsection
