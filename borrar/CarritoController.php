<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
        public function index()
    {
        $carritos = Carrito::all();

    return response()->json($carritos);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',            
                ]); 
        $carrito = Carrito::create($validatedData);

        return response()->json($carrito, 201);
    }
    public function show($id)
    {
        $carrito = Carrito::find($id);

        if ($carrito) {
            return response()->json($carrito);
        } else {
            return response()->json(['message' => 'Carrito no encontrado'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $carrito = Carrito::find($id);

        if ($carrito) {
            $validatedData = $request->validate([
                'usuario_id' => 'required|exists:usuarios,id',
                'producto_id' => 'required|exists:productos,id',
                'cantidad' => 'required|integer|min:1',
            ]);

            $carrito->update($validatedData);

            return response()->json($carrito);
        } else {
            return response()->json(['message' => 'Carrito no encontrado'], 404);
        }
    }
    public function destroy($id)
    {
        $carrito = Carrito::find($id);

        if ($carrito) {
            $carrito->delete();
            return response()->json(['message' => 'Carrito eliminado']);
        } else {
            return response()->json(['message' => 'Carrito no encontrado'], 404);
        }
    }
}
