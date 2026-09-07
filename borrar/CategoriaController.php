<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

    return response()->json($categorias);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:categorias,slug',
                'descripcion' => 'nullable|string',
            ]);
        $categoria = Categoria::create($validatedData);
        return response()->json($categoria, 201);

        //return response()->json($categoria, 201);
    }
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            return response()->json($categoria);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'slug' => 'required|string|max:255|unique:categorias,slug',
            ]);

            $categoria->update($validatedData);

            return response()->json($categoria);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();
            return response()->json(['message' => 'Categoría eliminada']);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }

}
