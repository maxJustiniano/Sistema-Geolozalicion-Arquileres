<x-layouts.auth :title="__('Iniciar sesión')">
    <form method="POST" action="{{ route('login') }}" class="p-8">
        @csrf

        <div>
            <h1 class="text-2xl font-semibold text-primary-custom text-center mb-6">Iniciar sesión</h1>

            <x-auth-session-status class="text-center" :status="session('status')" />

            <div class="space-y-4">

                <flux:input name="email" :label="__('Email')" type="email" required autofocus
                    autocomplete="email" placeholder="email@ejemplo.com" />

                <div class="relative">
                    <flux:input name="password" :label="__('Contraseña')" type="password" required
                        autocomplete="current-password" :placeholder="__('Contraseña')" viewable />

                    @if (Route::has('password.request'))
                        <flux:link
                            class="absolute top-0 text-sm end-0 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 hover:underline"
                            :href="route('password.request')" wire:navigate>
                            {{ __('Olvidaste tu contraseña?') }}
                        </flux:link>
                    @endif
                </div>

                <flux:checkbox name="remember" :label="__('Recuerdame')" :checked="old('remember')" />

                <flux:button type="submit"
                    class="w-full h-12 btn-primary-custom text-white font-medium rounded-lg"
                    data-test="login-button">
                    {{ __('Iniciar sesión') }}
                </flux:button>

                <div class="mt-6">
                    {{-- Separador "o continúa con" --}}
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-custom"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-card-custom text-secondary-custom">o continúa
                                con</span>
                        </div>
                    </div>

                    {{-- Botones Sociales (Google y Microsoft) --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <button type="button"
                            class="btn-secondary-custom border h-12 rounded-lg flex items-center justify-center space-x-2">
                            {{-- SVG Google --}}
                            <svg class="w-5 h-5" viewbox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span class="text-sm font-medium">Google</span>
                        </button>
                        <button type="button"
                            class="btn-secondary-custom border h-12 rounded-lg flex items-center justify-center space-x-2">
                            {{-- SVG Microsoft --}}
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="10" height="10" fill="#F25022" />
                                <rect x="2" y="12" width="10" height="10" fill="#00A4EF" />
                                <rect x="12" y="2" width="10" height="10" fill="#7FBA00" />
                                <rect x="12" y="12" width="10" height="10" fill="#FFB900" />
                            </svg>
                            <span class="text-sm font-medium">Microsoft</span>
                        </button>
                    </div>
                </div>

                {{-- Enlace a Registro --}}
                <p class="mt-6 text-center text-sm text-secondary-custom">

                    @if (Route::has('register'))
                        <div
                            class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                            <span>{{ __('¿No tenés cuenta?') }}</span>
                            <flux:link :href="route('register')" wire:navigate
                                class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 hover:underline">
                                {{ __('Crear una') }}
                            </flux:link>
                        </div>
                    @endif
                </p>
            </div>
        </div>
    </form>
</x-layouts.auth>