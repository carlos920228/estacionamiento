<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\estacionamiento;
use Inertia\Inertia;
use App\Http\Controllers\EstacionamientoController;
use App\Http\Controllers\EntradasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('estacionamiento',EstacionamientoController::class);
    Route::resource('entradas',EntradasController::class);
    Route::get('/ingresos', [EntradasController::class,'ingresos'])->name("ingresos");
    Route::get('/vehiculos', [EntradasController::class,'vehiculos'])->name("vehiculos");
    Route::get('/hora', [EntradasController::class,'hora'])->name("hora");
});
