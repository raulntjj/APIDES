<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthController {
    // Método de login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credênciais inválidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível concluir o login'], 500);
        }

        return response()->json(compact('token'));
    }

    // Método para obter usuário autenticado
    public function getAuthenticatedUser(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não existente'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token ausente'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    // Método de logout
    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Logout concluido com sucesso']);
    }
}
