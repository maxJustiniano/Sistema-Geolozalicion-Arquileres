<x-layouts.app :title="__('Crear/Editar Usuario')">
    <main class="py-6 px-4 sm:px-6 lg:px-8 w-full h-full">
        <div class="max-w-4xl mx-auto">
            <x-form :action="$action" :method="$method" 
                :routeIndex="$routeIndex" >
                
                {{-- --- Sección para mostrar ERRORES GENERALES (Opcional) --- --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <span class="font-medium">¡Ups! Hubo problemas con los datos enviados.</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- ----------------------------------------------------------------- --}}

                {{-- Nombre y Apellido --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="nombre_persona" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            Nombre
                        </label>
                        <input type="text" name="nombre_persona" id="nombre_persona" required
                               value="{{ $user->nombre_persona ?? old('nombre_persona', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                      @error('nombre_persona') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        {{-- Mostrar error específico para 'nombre_persona' --}}
                        @error('nombre_persona')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="apellido_persona" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            Apellido
                        </label>
                        <input type="text" name="apellido_persona" id="apellido_persona" required
                               value="{{ $user->apellido_persona ?? old('apellido_persona', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                       @error('apellido_persona') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        @error('apellido_persona')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email y Nombre de Usuario (Name) --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            Email
                        </label>
                        <input type="email" name="email" id="email" required
                               value="{{ $user->email ?? old('email', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                       @error('email') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            Nombre de Usuario (Login)
                        </label>
                        <input type="text" name="name" id="name" required
                               value="{{ $user->name ?? old('name', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                       @error('name') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Teléfono y DNI --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-6">
                    <div>
                        <label for="telefono_persona" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            Teléfono
                        </label>
                        <input type="text" name="telefono_persona" id="telefono_persona"
                               value="{{ $user->telefono_persona ?? old('telefono_persona', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                       @error('telefono_persona') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        @error('telefono_persona')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="dni_persona" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                            DNI
                        </label>
                        <input type="text" name="dni_persona" id="dni_persona"
                               value="{{ $user->dni_persona ?? old('dni_persona', '') }}"
                               class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                       @error('dni_persona') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        @error('dni_persona')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                {{-- Contraseña (Solo si estamos creando o si se cambia en la edición) --}}
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                        Contraseña @if(isset($user->id)) (Dejar vacío para no cambiar) @endif
                    </label>
                    <input type="password" name="password" id="password" @if(!isset($user->id)) required @endif
                           class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                   @error('password') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña de confirmación --}}
                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                        Confirmar Contraseña
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" @if(!isset($user->id)) required @endif
                           class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                   @error('password_confirmation') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Rol (Necesitarás pasar la lista de Roles desde el controlador) --}}
                <div class="mt-6">
                    <label for="id_rol" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1"> 
                        Rol
                    </label>
                    <select name="id_rol" id="id_rol" required
                            class="block w-full px-3 py-2 border rounded-lg bg-white dark:bg-zinc-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 text-sm transition-colors
                                    @error('id_rol') border-red-500 dark:border-red-400 @else border-neutral-300 dark:border-neutral-600 @enderror">
                        {{-- Mantiene la selección anterior en caso de error o la predeterminada en edición --}}
                        @php
                            $selectedRol = old('id_rol', $user->id_rol ?? null);
                        @endphp
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" 
                                {{ $selectedRol == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre_rol }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_rol')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

            </x-form>
        </div>
    </main>
</x-layouts.app>