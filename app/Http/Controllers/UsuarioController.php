<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

    return response()->json($usuarios);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:8',
        ]); 
        $usuario = Usuario::create($validatedData);

        return response()->json($usuario, 201);
    }
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios,email',
                'password' => 'required|string|min:8',
            ]);

            $usuario->update($validatedData);

            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            $usuario->delete();
            return response()->json(['message' => 'Usuario eliminado']);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}
