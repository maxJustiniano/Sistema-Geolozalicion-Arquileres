<?php

//Use predefinidos de livewire
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

//Use de rutas personalizadas
use App\Http\Controllers\Auth\registerController; //Controlador del register


//Routes predefinidos de livewire
Route::get('/', function () {
    return view('welcome');
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

//Rutas de Estaticas Personalizadas (Home y error)
Route::get('/error404', function () {
    return view('errors/404');
})->name('error404');

Route::get('/home', function () {
    return view('home');
})->name('home');


//Rutas de Registro Personalizadas (Auth)

// Ruta GET para mostrar el formulario de registro
Route::get('/register', [registerController::class, 'create'])
    ->middleware('guest');

// Ruta POST para procesar el envío del formulario y registrar al usuario
Route::post('/register', [registerController::class, 'store'])
    ->middleware('guest')
    ->name('register');


//Rutas de Crud personas Personalizadas

Route::middleware(['auth'])->group(function () {

    Route::get('/usuarios', function () {
        return view('usuarios.index');
    })->name('usuarios');

    Route::get('/roles', function () {
        return view('roles.index');
    })->name('roles');

});
