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

Route::prefix('v1')->middleware('throttle:10,1')->group(function () {
    Route::apiResource('categorias', CategoriaController::class)->middleware(['auth:api','admin']);
    Route::apiResource('productos', ProductoController::class)->middlewareFor(['store','update','destroy'],['auth:api','admin']);
    Route::apiResource('usuarios', UsuarioController::class)->middleware(['auth:api','admin']);

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware('auth:api')->group(function () {
        Route::put('/profile', [AuthController::class, 'update']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });

    Route::middleware('auth:api')->prefix('carrito')->group(function (){
        Route::get('/', [CarritoController::class, 'index']);
        Route::delete('/', [CarritoController::class, 'destroy']);
        Route::delete('/items/{carritoitem}', [CarritoController::class, 'delete']);
        Route::post('/', [CarritoController::class, 'store']);
    });
});
