<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarritoRequest;
use App\Http\Resources\CarritoitemResource;
use App\Http\Resources\CarritoResource;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Usuario;
use App\Services\CarritoitemService;
use App\Services\CarritoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    /**
     * Muestra todos los carritos
     */
    public function index(): JsonResponse
    {
        $carritos = Carrito::with('items.producto')->get();

        return response()->json($carritos, 200);
    }

    /**
     * Crea o actualiza carrito creando o actualizando un item (producto)
     */
    public function store(
        StoreCarritoRequest $request,
        CarritoService $carritoService,
        CarritoitemService $carritoitemService,
    ) : JsonResponse 
    {
        $item = DB::transaction(function () use ($request, $carritoService, $carritoitemService) {
            $carrito = $carritoService->findOrCreateCarrito(
                (int) $request->validated('usuario_id'),
            );

            return $carritoitemService->findOrCreateCarritoitem($carrito, $request->toDTO());
        });
        return response()->json(new CarritoitemResource($item->load('producto')), 201);
    }

    /**
     * Muestra el carrito de usuario.
     */
    public function show(Usuario $usuario): JsonResponse
    {
        $carrito = $usuario->carrito()
            ->with('items.producto')
            ->first();

        if ($carrito === null) {
            return response()->json([
                'message' => 'El usuario no tiene un carrito activo.',
            ], 404);
        }

        return response()->json(new CarritoResource($carrito), 200);
    }
    /**
     * Borra Carrito completo del usuario.
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
     * Borra un producto de un usuario.
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
