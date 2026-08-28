<?php

use App\Http\Controllers\Api\V1\AuthController;
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
    Route::apiResource('categorias', CategoriaController::class)->middleware('throttle:10,1')->middleware('auth:api')->middleware('admin');
    Route::apiResource('productos', ProductoController::class)->middleware('throttle:10,1')->middleware('auth:api')->middleware('admin');
    Route::apiResource('usuarios', UsuarioController::class);
    Route::get('/carritos', [CarritoController::class, 'index']);
    Route::get('/carritos', [CarritoController::class, 'show']);
    Route::delete('/carritos', [CarritoController::class, 'destroy']);
    Route::delete('/carritos/items/{producto}', [CarritoController::class, 'delete']);
    Route::post('/carritos', [CarritoController::class, 'store']);

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});
