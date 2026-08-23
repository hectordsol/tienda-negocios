<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProductoResource;
use App\Services\ProductoService;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $productos = Producto::query()
                    ->when($request->nombre, 
                            function ($query,$nombre) {
                                $query->where('nombre', 'like', "%{$nombre}%");
                            })
            ->get();

        return ProductoResource::collection($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request, ProductoService $productoService): JsonResponse
    {         
        $producto = $productoService->createProducto($request->toDTO());

        return response()->json(new ProductoResource($producto), 201);
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
