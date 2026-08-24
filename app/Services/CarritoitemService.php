<?php

namespace App\Services;

use App\DTO\CarritoitemDTO;
use App\Models\Carrito;
use App\Models\Carritoitem;

class CarritoitemService
{
    public function findOrCreateCarritoitem(Carrito $carrito, CarritoitemDTO $carritoitemDTO): Carritoitem
    {
        $item = $carrito->items()
            ->where('producto_id', $carritoitemDTO->producto_id)
            ->first();

        if ($item !== null) {
            $item->update(['cantidad' => $carritoitemDTO->cantidad]);

            return $item->refresh();
        }

        return $carrito->items()->create([
            'producto_id' => $carritoitemDTO->producto_id,
            'cantidad' => $carritoitemDTO->cantidad,
            'precio_unitario' => $carritoitemDTO->precio_unitario,
        ]);
    }
}
