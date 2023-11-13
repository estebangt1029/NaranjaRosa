<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\DashboardController;




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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'show'])->name('products.edit');
    // Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/entradas/create', [EntradaController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');
    Route::get('/entradas/{entrada}/edit', [EntradaController::class, 'show'])->name('entradas.edit');
    // Route::post('/entradas/update', [EntradaController::class, 'update'])->name('entradas.update');
    Route::put('/entradas/{entrada}', [EntradaController::class, 'update'])->name('entradas.update');
    Route::get('/entradas/{entrada}/delete', [EntradaController::class, 'destroy'])->name('entradas.destroy');

    Route::get('/salidas', [SalidaController::class, 'index'])->name('salidas.index');
    Route::get('/salidas/create', [SalidaController::class, 'create'])->name('salidas.create');
    Route::post('/salidas', [SalidaController::class, 'store'])->name('salidas.store');
    Route::get('/salidas/{salida}/edit', [SalidaController::class, 'show'])->name('salidas.edit');
    // Route::post('/salidas/update', [salidaController::class, 'update'])->name('salidas.update');
    Route::put('/salidas/{salida}', [SalidaController::class, 'update'])->name('salidas.update');
    Route::get('/salidas/{salida}/delete', [SalidaController::class, 'destroy'])->name('salidas.destroy');


    //pdf
    Route::get('/generar-pdf-productos', [ProductController::class, 'generatePDF']);
    Route::get('/generar-pdf-entradas', [EntradaController::class, 'generatePDF']);
    Route::get('/generar-pdf-salidas', [SalidaController::class, 'generatePDF']);


    Route::get('/generar-excel-productos', [ProductController::class, 'generateEXCEL']);
    Route::get('/generar-excel-entradas', [EntradaController::class, 'generateEXCEL']);
    Route::get('/generar-excel-salidas', [SalidaController::class, 'generateEXCEL']);

});
