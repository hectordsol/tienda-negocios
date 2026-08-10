<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productos = [
            ['id' => 1, 'name' => 'Producto 1', 'price' => 10.99],
            ['id' => 2, 'name' => 'Producto 2', 'price' => 19.99],
            ['id' => 3, 'name' => 'Producto 3', 'price' => 5.99],
        ];
    return response()->json($productos);
    }
    public function show($id)
    {
        $productos = [
            ['id' => 1, 'name' => 'Producto 1', 'price' => 10.99],
            ['id' => 2, 'name' => 'Producto 2', 'price' => 19.99],
            ['id' => 3, 'name' => 'Producto 3', 'price' => 5.99],
        ];

        $producto = collect($productos)->firstWhere('id', $id);

        if ($producto) {
            return response()->json($producto);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
}
