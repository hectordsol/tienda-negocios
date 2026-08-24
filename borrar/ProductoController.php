<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

    return response()->json($productos);
    }
    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());

        return response()->json($producto, 201);
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nombre' => 'required|string|max:255',
    //         'descripcion' => 'nullable|string',
    //         'precio' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //         'categoria_id' => 'required|exists:categorias,id',
    //     ]); 
    //     $producto = Producto::create($validatedData);

    //     return response()->json($producto, 201);
    // }
    public function show($id)
    {
        $producto = Producto::find($id);

        if ($producto) {
            return response()->json($producto);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $validateData = $request->validated();

        $producto->update($validateData);

        return response()->json($producto); 
    //     $producto = Producto::find($id);

    //     if ($producto) {
    //         $validatedData = $request->validated();

    //         $producto->update($validatedData);

    //         return response()->json($producto);
    //     } else {
    //         return response()->json(['message' => 'Producto no encontrado'], 404);
    //     }
    }
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if ($producto) {
            $producto->delete();
            return response()->json(['message' => 'Producto eliminado']);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
}
