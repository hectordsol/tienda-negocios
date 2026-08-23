<?php

namespace App\Services;

use App\DTO\ProductoDTO;
use App\Models\Producto;

class ProductoService
{
    /**
     * Create a new class instance.
     */
    public  function createProducto(ProductoDTO $productoDTO): Producto
    {
        return Producto::create($productoDTO->toArray());
    }
}
