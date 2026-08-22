<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $usuarios = Usuario::all();

        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request): JsonResponse
    {
        $usuario = Usuario::create($request->validated());

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario): JsonResponse
    {
        return response()->json($usuario, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario): JsonResponse
    {
        $usuario->update($request->validated());

        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario): JsonResponse
    {
        $usuario->delete();

        return response()->json($usuario, 204);
    }
}
