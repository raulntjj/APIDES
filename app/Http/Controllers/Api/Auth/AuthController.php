<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Tymon\JWTAuth\Exceptions;

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
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token ausente'], $e->getStatusCode());
        }

        $user = $user->load('participant');
        return response()->json(compact('user'));
    }

    // Método para deslogar o usuário
    public function logout(){
        try {
            // Invalidar o token JWT
            JWTAuth::invalidate(JWTAuth::parseToken());

            // Retornar resposta de sucesso
            return response()->json(['message' => 'Logout realizado com sucesso'], 200);
        } catch (\JWTException $e) {
            // Retornar resposta de erro se houver falha ao invalidar o token
            return response()->json(['error' => 'Falha ao deslogar, por favor tente novamente'], 500);
        }
    }
}
