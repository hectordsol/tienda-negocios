<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $token = auth('api')->attempt($credenciales);

        if ($token === false) {
            return response()->json([
                'message' => 'Las credenciales no son válidas.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $usuario = auth('api')->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'usuario' => $usuario,
        ], Response::HTTP_OK);
    }

    public function register(StoreUsuarioRequest $request): JsonResponse
    {
        $datos = $request->validated();
        $usuario = Usuario::create($datos);
        $credenciales = [
            'email' => $datos['email'],
            'password' => $datos['password'],
        ];
        $token = auth('api')->attempt($credenciales);
        if ($token === false) {
            return response()->json([
                'message' => 'No se pudo autenticar al usuario registrado.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'usuario' => $usuario,
        ], 201);
    }

    public function profile(): JsonResponse
    {
        return response()->json(auth('api')->user());
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ], Response::HTTP_OK);
    }

    public function update(UpdateUsuarioRequest $updateUsuario): JsonResponse
    {
        $usuario = auth('api')->user();

        if (! $usuario instanceof Usuario) {
            return response()->json([
                'message' => 'No autenticado.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $datos = $updateUsuario->validated();

        if (isset($datos['password'])) {
            $datos['password'] = bcrypt($datos['password']);
        }

        $usuario->update($datos);

        return response()->json([
            'message' => 'Usuario actualizado correctamente.',
            'usuario' => $usuario->fresh(),
        ], Response::HTTP_OK);

    }
}
