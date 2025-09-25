@extends('layouts.form-auth')

@section('title', 'Registro')

@section('content')

    <h1 class="text-3xl font-bold mb-6 text-center text-white">Crear cuenta</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="text-sm text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nombre --}}
        <div>
            <label for="name" class="block font-medium text-sm text-gray-200">Nombre de usuario</label>
            <input
                class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Tu nombre"
                required
                autofocus
                autocomplete="username"
            />
        </div>

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
                autocomplete="email"
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
                autocomplete="new-password"
            />
        </div>

        {{-- Confirmación --}}
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-200">Confirmar contraseña</label>
            <input
                class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="••••••••"
                required
                autocomplete="new-password"
            />
        </div>

        {{-- Botón --}}
        <div class="flex items-center justify-end">
            <button
                type="submit"
                class="w-full py-3 rounded-lg bg-blue-600 hover:bg-blue-700 transition font-semibold text-white tracking-wide shadow-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
                Registrarse
            </button>
        </div>
    </form>

    {{-- Login link --}}
    <p class="mt-6 text-center text-sm text-gray-400">
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Inicia sesión aquí</a>
    </p>

@endsection
