<?php

namespace App\Services;

use App\DTO\ProductoDTO;
use App\Models\Producto;

class ProductoService
{
    public function createProducto(ProductoDTO $productoDTO): Producto
    {
        return Producto::create($productoDTO->toArray());
    }
}
