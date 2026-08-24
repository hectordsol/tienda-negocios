<?php

namespace App\Services;

use App\Models\Carrito;

class CarritoService
{
    public function findOrCreateCarrito(int $usuarioId): Carrito
    {
        return Carrito::firstOrCreate(
            ['usuario_id' => $usuarioId],
            ['estado' => 'activo'],
        );
    }
}
