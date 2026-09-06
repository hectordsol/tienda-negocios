<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarritoitemRequest;
use App\Http\Resources\CarritoitemResource;
use App\Http\Resources\CarritoResource;
use App\Models\Carritoitem;
use App\Models\Usuario;
use App\Services\CarritoitemService;
use App\Services\CarritoService;
use App\Services\ResumenCarritoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CarritoController extends Controller
{
    /**
     * Muestra todos los carritos
     */
    public function index(ResumenCarritoService $resumenCarritoService): JsonResponse
    {
        $usuario = auth('api')->user();
        if (! $usuario instanceof Usuario) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $usuario->carrito()
            ->where('estado', 'activo')
            ->with('items.producto')
            ->first();

        if ($carrito === null) {
            return response()->json([
                'error' => 'El usuario no tiene un carrito activo.',
            ], 404);
        }

        return response()->json(new CarritoResource(
            $carrito->items,
            $resumenCarritoService->calcular($carrito->items),
        ));
    }

    /**
     * Crea o actualiza carrito creando o actualizando un item (producto)
     */
    public function store(
        StoreCarritoitemRequest $requestcarritoitem,
        CarritoService $carritoService,
        CarritoitemService $carritoitemService,
    ): JsonResponse {
        $usuario = auth('api')->user();

        if ($usuario === null) {
            return response()->json([
                'message' => 'No autenticado.',
            ], 401);
        }

        $item = DB::transaction(function () use ($requestcarritoitem, $carritoService, $carritoitemService, $usuario) {
            $carrito = $carritoService->findOrCreateCarrito((int) $usuario->id);

            return $carritoitemService->findOrCreateCarritoitem($carrito, $requestcarritoitem->toDTO());
        });

        return response()->json(new CarritoitemResource($item->load('producto')), 201);
    }

    /**
     * Borra item del Carrito del usuario logueado.
     */
    public function delete(Carritoitem $carritoitem): JsonResponse
    {
        $usuarioId = auth('api')->id();

        if ($usuarioId === null) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $carritoitem->carrito()
            ->where('usuario_id', $usuarioId)
            ->where('estado', 'activo')
            ->first();

        if ($carrito === null || $carritoitem->carrito_id !== $carrito->id) {
            return response()->json([
                'error' => 'El item no existe en el carrito del usuario actual.',
            ], 404);
        }

        $carritoitem->delete();

        return response()->json([
            'message' => 'item eliminado del carrito',
        ], 204);
    }

    /**
     * Borra el carrito activo del usuario logueado.
     */
    public function destroy(): JsonResponse
    {
        $usuario = auth('api')->user();

        if (! $usuario instanceof Usuario) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $usuario->carrito()->first();

        if ($carrito === null) {
            return response()->json([
                'error' => 'El usuario no tiene un carrito activo.',
            ], 404);
        }

        $carrito->delete();

        return response()->json([
            'message' => 'Carrito eliminado con éxito.',
        ], 204);
    }

    public function checkout(ResumenCarritoService $resumenCarritoService): JsonResponse
    {
        $usuario = auth('api')->user();

        if (! $usuario instanceof Usuario) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $usuario->carrito()
            ->where('estado', 'activo')
            ->with('items.producto')
            ->first();

        if ($carrito === null) {
            return response()->json([
                'error' => 'El usuario no tiene un carrito activo.',
            ], 404);
        }

        if ($carrito->items->isEmpty()) {
            return response()->json([
                'error' => 'El carrito está vacío.',
            ], 422);
        }

        $resumen = DB::transaction(function () use ($carrito, $resumenCarritoService): array {
            $carrito->load('items.producto');

            foreach ($carrito->items as $item) {
                if ($item->producto === null) {
                    throw ValidationException::withMessages([
                        'carrito' => 'El producto asociado al item no existe.',
                    ]);
                }

                if ($item->producto->stock < $item->cantidad) {
                    throw ValidationException::withMessages([
                        'carrito' => 'No hay stock suficiente para el producto '.$item->producto->nombre.'.',
                    ]);
                }
            }

            $resumen = $resumenCarritoService->calcular($carrito->items);

            foreach ($carrito->items as $item) {
                $item->producto->decrement('stock', $item->cantidad);
            }

            $carrito->update(['estado' => 'finalizado']);

            return $resumen;
        });

        return response()->json([
            'message' => 'Checkout realizado con éxito.',
            'resumen' => $resumen,
        ], 200);
    }
}
