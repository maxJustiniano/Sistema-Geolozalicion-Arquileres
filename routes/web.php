<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//------------ Rutas Login ----------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/dashboard', function () {
    // Solo los usuarios autenticados pueden acceder
    return view('welcome');
});

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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});