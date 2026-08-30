<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
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

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function register(StoreUsuarioRequest $request)
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
        ]);
    }

    public function profile()
    {
        return response()->json(auth('api')->user());
    }
}
