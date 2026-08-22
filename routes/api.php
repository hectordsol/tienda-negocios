<?php

use App\Http\Controllers\Api\V1\CarritoController;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\ProductoController;
use App\Http\Controllers\Api\V1\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/usuarios', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('productos', ProductoController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::get('/carritos/{usuario}', [CarritoController::class, 'show']);
    Route::delete('/carritos/{usuario}', [CarritoController::class, 'delete']);
    Route::delete('/carritos/{usuario}/productos/{producto}', [CarritoController::class, 'destroy']);
    Route::apiResource('carritos', CarritoController::class);
});
