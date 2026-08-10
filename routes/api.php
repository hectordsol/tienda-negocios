<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/productos', [ProductController::class, 'index']
    )->name('api.productos.v1');

    Route::get('/productos/{id}', [ProductController::class, 'show']
    )->name('api.productos.show');

    });