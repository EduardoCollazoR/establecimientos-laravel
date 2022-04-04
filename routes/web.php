<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InicioController;

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

Route::get('/', [InicioController::class])->name('inicio');

Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establecimientos/create', [EstablecimientoController::class, 'create'])->name('establecimiento.create')->middleware('revisar');

    Route::post('/establecimiento', [EstablecimientoController::class, 'store'])->name('establecimiento.store');

    Route::get('/establecimientos/edit', [EstablecimientoController::class, 'edit'])->name('establecimiento.edit');


    Route::put('/establecimientos/{establecimiento}', [EstablecimientoController::class, 'update'])->name('establecimiento.update');

    Route::post('/imagenes/store', [ImagenController::class, 'store'])->name('imagenes.store');

    Route::post('/imagenes/destroy', [ImagenController::class, 'destroy'])->name('imagenes.destroy');
});
