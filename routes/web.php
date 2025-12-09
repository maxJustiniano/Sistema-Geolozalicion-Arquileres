<?php

// Use predefinidos de livewire
use App\Http\Controllers\Auth\registerController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
// Use de rutas personalizadas
use Laravel\Fortify\Features; // Controlador del register
use App\Http\Controllers\IdentidadUsuario\RolesController;
use App\Http\Controllers\IdentidadUsuario\UsuariosController;

use App\Http\Controllers\IdentidadUsuario\PropiedadesController;

// Routes predefinidos de livewire
Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\MapaController;

Route::get('/propiedades-mapa', [MapaController::class, 'index']);

Route::get('/cargar-inmueble', function () {
    return view('cargar_inmueble');
});

Route::get('/detalle-inmueble', function () {
    return view('detalle_inmueble');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::get('/sobrenosotros', function () {
    return view('info');
})->name('info');

// Simplemente muestra la vista 'home_init' que contiene el componente Livewire
Route::get('/inicio', function () {
    return view('home_init');
})->name('inicio');

// Rutas de Registro Personalizadas (Auth)

// Ruta GET para mostrar el formulario de registro
Route::get('/register', [registerController::class, 'create'])
    ->middleware('guest');

// Ruta POST para procesar el envío del formulario y registrar al usuario
Route::post('/register', [registerController::class, 'store'])
    ->middleware('guest')
    ->name('register');

// Rutas de Crud personas Personalizadas
Route::middleware('check_user_type:3')->group(function () {

    // Ruta POST para procesar el envío del formulario y registrar al usuario
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

    // Ruta POST para procesar el envío del formulario y registrar al usuario
    Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');

    // Rutas de Edición/Actualización
    Route::get('/usuarios/{user}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}/update', [UsuariosController::class, 'update'])->name('usuarios.update'); // Usamos PUT

    // Ruta de Eliminación
    Route::delete('/usuarios/{user}/destroy', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    // Ruta POST para procesar el envío del formulario y registrar al usuario
    Route::get('/roles', [RolesController::class, 'index'])
        ->name('roles.index');

    // Ruta POST para procesar el envío del formulario y registrar al usuario
    Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');

    // Rutas de Edición/Actualización
    Route::get('/roles/{rol}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{rol}/update', [RolesController::class, 'update'])->name('roles.update'); // Usamos PUT

    // Ruta de Eliminación
    Route::delete('/roles/{rol}/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
});


// Ruta POST para procesar el envío del formulario (método store del controlador)
Route::post('/cargar-inmueble', [PropiedadesController::class, 'store'])->name('propiedades.store');