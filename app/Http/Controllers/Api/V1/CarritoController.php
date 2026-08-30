<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarritoRequest;
use App\Http\Resources\CarritoitemResource;
use App\Http\Resources\CarritoResource;
use App\Models\Carrito;
use App\Models\Carritoitem;
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
        $usuario = auth('api')->user();
        if (! $usuario instanceof Usuario) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $usuario->carrito()
            ->with('items.producto')
            ->first();

        if ($carrito === null) {
            return response()->json([
                'error' => 'El usuario no tiene un carrito activo.',
            ], 404);
        }
        return response()->json(new CarritoResource($carrito), 200);
    }

    /**
     * Crea o actualiza carrito creando o actualizando un item (producto)
     */
    public function store(
        StoreCarritoRequest $request,
        CarritoService $carritoService,
        CarritoitemService $carritoitemService,
    ): JsonResponse {
        $usuario = auth('api')->user();

        if ($usuario === null) {
            return response()->json([
                'message' => 'No autenticado.',
            ], 401);
        }

        $item = DB::transaction(function () use ($request, $carritoService, $carritoitemService, $usuario) {
            $carrito = $carritoService->findOrCreateCarrito((int) $usuario->id);

            return $carritoitemService->findOrCreateCarritoitem($carrito, $request->toDTO());
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

    public function checkout(): JsonResponse
    {
        $usuario = auth('api')->user();

        if (! $usuario instanceof Usuario) {
            return response()->json([
                'error' => 'No autenticado.',
            ], 401);
        }

        $carrito = $usuario->carrito()->with('items.producto')->first();

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

        $resumen = DB::transaction(function () use ($carrito) {
            $subtotal = 0.0;

            foreach ($carrito->items as $item) {
                $producto = $item->producto;

                if ($producto === null) {
                    abort(422, 'El producto asociado al item no existe.');
                }

                if ($producto->stock < $item->cantidad) {
                    abort(422, 'No hay stock suficiente para el producto '.$producto->nombre.'.');
                }

                $subtotal += (float) $item->cantidad * (float) $item->precio_unitario;
            }

            $impuesto = round($subtotal * 0.21, 2);
            $gastosDeEnvio = $subtotal < 10000 ? 5000 : 0;
            $total = round($subtotal + $impuesto + $gastosDeEnvio, 2);

            foreach ($carrito->items as $item) {
                $producto = $item->producto;
                $producto->stock = $producto->stock - $item->cantidad;
                $producto->save();
            }

            $carrito->estado = 'finalizado';
            $carrito->save();

            return [
                'SUBTOTAL' => round($subtotal, 2),
                'IMPUESTO' => round($impuesto, 2),
                'GASTOS_DE_ENVIO' => $gastosDeEnvio,
                'TOTAL' => round($total, 2),
            ];
        });

        return response()->json([
            'message' => 'Checkout realizado con éxito.',
            'resumen' => $resumen,
        ], 200);
    }
}
