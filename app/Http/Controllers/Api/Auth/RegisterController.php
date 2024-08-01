<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\UserRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class RegisterController {
    // Método de registro
    public function registerAccount(UserRequest $request){
        if(!$request){
            return response()->json(['Error' => 'Request data not found', 400]);
        }

        if(!$this->registerService->register($request)){
            return response()->json(['Error' => 'Server error', 500]);
        }

        return $this->sendTokenVerification($request->email);
    }

    // Método de registro
    private function sendTokenVerification($email){
        if(!$this->registerService->sendToken($email)){
            return response()->json(['Error' => 'Server error', 500]);
        }

        return response()->json(['success' => 'Token submitted', 400]);
    }

    public function confirmTokenVerification(Request $request){
        //Verificando usuário autenticado com o token recebido
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['Error' => 'User not found'], 404);
        }

        if(!$request->token){
            return response()->json(['Error' => 'Token not exists', 400]);
        }


        if(!$this->registerService->confirmToken($request->email, $request->token)){
            return response()->json(['Error' => 'Token does not match', 500]);
        }

        return response()->json(['success' => 'Token confirmed', 400]);
    }

}
