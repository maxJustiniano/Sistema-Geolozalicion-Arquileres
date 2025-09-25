<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

//------------------------ Rutas Login y register ------------------------

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


//---------------------------- Rutas publicas ----------------------------

Route::get('/dashboard', function () {
    // Solo los usuarios autenticados pueden acceder
    return view('welcome');
});

//----------------------------- Rutas privadas -----------------------------

// Grupo de rutas protegidas para usuarios autenticados
Route::middleware('auth')->group(function () {
    
    // Rutas para usuarios con tipo_user_id = 1 (simple)
    Route::middleware('check_user_type:1')->group(function () {
        Route::get('/simple-dashboard', function () {
            return view('auth.simpe.welcome');
        });
    });

    // Rutas para usuarios con tipo_user_id = 2 (admin)
    Route::middleware('check_user_type:2')->group(function () {
        Route::get('/admin-dashboard', function () {
            return view('auth.simpe');
        });
    });

    // Cerrar sesión
    Route::post('/logout', [LoginController::class, 'destroyer'])->name('logout');
});