<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarritoRequest;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $carritos = Carrito::with('items.producto')->get();

        return response()->json($carritos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarritoRequest $request): JsonResponse
    {
        $datos = $request->validated();
        $carrito = Carrito::firstOrCreate([
            'usuario_id' => $datos['usuario_id'],
            'estado' => 'activo',
        ]);

        $item = $carrito->items()->updateOrCreate(
            ['producto_id' => $datos['producto_id']],
            [
                'cantidad' => $datos['cantidad'],
                'precio_unitario' => Producto::findOrFail($datos['producto_id'])->precio,
            ],
        );
        return response()->json($item->load('producto'), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario): JsonResponse
    {
        $items = $usuario->carritoItems()
            ->with('producto')
            ->get()
            ->filter()
            ->values();

        return response()->json($items, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete(Usuario $usuario): JsonResponse
    {
        $usuario->carrito()->delete();

        return response()->json([
                'message' => 'Carrito eliminado',
                'usuario' => $usuario,
            ], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario, Producto $producto): JsonResponse
    {

        $item = $usuario->carritoItems()
            ->whereBelongsTo($producto, 'producto')
            ->first();

        if ($item === null) {
            return response()->json([
                'message' => 'El producto no está en el carrito del usuario.',
            ], 404);
        }

        $item->delete();

        return response()->json([
                'message' => 'Producto de Carrito eliminado',
            ], 204);
    }
}
