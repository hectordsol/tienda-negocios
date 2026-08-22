<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $productos = Producto::all();

        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request): JsonResponse
    {
        $producto = Producto::create($request->validated());

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto): JsonResponse
    {
        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto): JsonResponse
    {

        $producto->update($request->validated());

        return response()->json($producto, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto): JsonResponse
    {
        $producto->delete();

        return response()->json($producto, 204);
    }
}
