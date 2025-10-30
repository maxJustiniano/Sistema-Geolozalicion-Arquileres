<x-layouts.auth-movil :title="__('Crear cuenta')">
    <form method="POST" action="{{ route('register') }}" class="p-8">
        @csrf

        <div>
            <h1 class="text-2xl font-semibold text-primary-custom text-center mb-6">Crear cuenta</h1>

            {{-- Reemplazado session('status') con el componente de status si existe --}}
            <x-auth-session-status class="text-center" :status="session('status')" />

            <div class="space-y-4">

                {{-- Campos de Nombre y Apellido: Usando flux:input en grid --}}
                <div class="grid grid-cols-2 gap-3">
                    <flux:input name="name" :label="__('Nombre')" type="text" required autofocus
                        autocomplete="given-name" placeholder="Nombre" maxlength="100" />

                    {{-- Nota: Asumimos que tu validación de Laravel espera 'lastName', si no, cámbialo a 'last_name' --}}
                    <flux:input name="lastName" :label="__('Apellido')" type="text" required
                        autocomplete="family-name" placeholder="Apellido" maxlength="100" />
                </div>

                {{-- Campo Email --}}
                <flux:input name="email" :label="__('Email')" type="email" required autocomplete="username"
                    placeholder="email@ejemplo.com" />

                {{-- Campos de Teléfono y DNI: Usando flux:input en grid --}}
                <div class="grid grid-cols-2 gap-3">
                    <flux:input name="phone" :label="__('Teléfono')" type="tel" placeholder="+54 11 1234-5678"
                        maxlength="20" />

                    <flux:input name="dni" :label="__('DNI')" type="text" placeholder="12345678"
                        pattern="[0-9]{8}" maxlength="8" />
                </div>

                {{-- Campo Contraseña --}}
                <flux:input name="password" :label="__('Contraseña')" type="password" required
                    autocomplete="new-password" placeholder="Contraseña" viewable />

                {{-- Campo Confirmar Contraseña --}}
                {{-- Nota: Laravel espera 'password_confirmation' para la validación --}}
                <flux:input name="password_confirmation" :label="__('Confirmar Contraseña')" type="password" required
                    autocomplete="new-password" placeholder="Confirmar Contraseña" viewable />

                {{-- Tipo de usuario (Radio Buttons) --}}
                <div>
                    <label class="block text-sm font-medium text-primary-custom mb-2">Tipo de usuario</label>
                    <div class="grid grid-cols-2 gap-3">
                        {{-- Usando flux:radio si tienes un componente para simplificar --}}
                        {{-- Si no tienes flux:radio, usa el HTML original, pero simplificaremos con una opción si existe --}}

                        <label
                            class="flex items-center p-3 border border-custom rounded-lg cursor-pointer hover-card-custom">
                            <input type="radio" name="userType" value="owner"
                                {{ old('userType') == 'owner' ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-custom border-custom focus-ring-custom" required>
                            <span class="ml-2 text-sm font-medium text-primary-custom">Propietario</span>
                        </label>
                        <label
                            class="flex items-center p-3 border border-custom rounded-lg cursor-pointer hover-card-custom">
                            <input type="radio" name="userType" value="tenant"
                                {{ old('userType') == 'tenant' ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-custom border-custom focus-ring-custom" required>
                            <span class="ml-2 text-sm font-medium text-primary-custom">Inquilino</span>
                        </label>
                    </div>
                    @error('userType')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Términos y Condiciones (Checkbox) --}}
                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" value="1"
                        {{ old('terms') ? 'checked' : '' }}
                        class="w-4 h-4 mt-1 text-blue-custom border-custom rounded focus-ring-custom @error('terms') border-red-500 @enderror"
                        required>
                    <div class="ml-2">
                        <span class="text-sm text-secondary-custom"> Acepto los
                            <flux:link href="#" class="text-blue-600 hover:text-blue-700 hover:underline">Términos
                                de Servicio y la de Privacidad</flux:link>
                        </span>
                        @error('terms')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Botón de Registro --}}
                <flux:button type="submit" class="w-full h-12 btn-primary-custom text-white font-medium rounded-lg">
                    {{ __('Registrarme') }}
                </flux:button>

                {{-- Enlace a Iniciar Sesión --}}
                <div class="mt-6 text-center text-sm text-secondary-custom">
                    @if (Route::has('login'))
                        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                            <span>{{ __('¿Ya tenés cuenta?') }}</span>
                            {{-- 💡 QUITAMOS wire:navigate para evitar el conflicto entre layouts --}}
                            <flux:link :href="route('login')" wire:navigate
                                class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 hover:underline">
                                {{ __('Iniciar sesión') }}
                            </flux:link>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</x-layouts.auth-movil>
