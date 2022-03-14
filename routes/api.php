<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Listado de API
Route::get('/establecimientos/{establecimiento}', [APIController::class, 'show'])->name('establecimientos.show');
Route::get('/categorias', [APIController::class, 'categorias'])->name('categorias');

Route::get('/categorias/{categoria}', [APIController::class, 'categoria'])->name('categoria');
