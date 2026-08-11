<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;

Route::get('/usuarios', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

 Route::get('/usuarios', [UsuarioController::class, 'index']);
 Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
 Route::post('/usuarios', [UsuarioController::class, 'store']);
 Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
 Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

 Route::get('/productos', [ProductoController::class, 'index']);
 Route::get('/productos/{id}', [ProductoController::class, 'show']);
 Route::post('/productos/', [ProductoController::class, 'store']);
 Route::put('/productos/{producto}', [ProductoController::class, 'update']);
 Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

 Route::get('/carrito', [CarritoController::class, 'index']);
 Route::get('/carrito/{id}', [CarritoController::class, 'show']);
 Route::post('/carrito/', [CarritoController::class, 'store']);
 Route::put('/carrito/{id}', [CarritoController::class, 'update']);
 Route::delete('/carrito/{id}', [CarritoController::class, 'destroy']);
