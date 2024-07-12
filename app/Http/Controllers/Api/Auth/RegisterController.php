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
            return response()->json(['error' => 'dados ausente', 400]);
        }

        if(!$this->registerService->register($request)){
            return response()->json(['error' => 'Server Error', 500]);
        }

        return $this->sendTokenVerification($request->email);
    }

    // Método de registro
    private function sendTokenVerification($email){
        if(!$email){
            return response()->json(['error' => 'Email ausente', 400]);
        }

        if(!$this->registerService->sendToken($email)){
            return response()->json(['error' => 'Server Error', 500]);
        }

        return response()->json(['message' => 'Token enviado com sucesso', 400]);
    }

    public function confirmTokenVerification(Request $request){
        if(!$request->token){
            return response()->json(['error' => 'Token ausente', 400]);
        }

        if(!$this->registerService->confirmToken($email)){
            return response()->json(['error' => 'Server Error', 500]);
        }

        return response()->json(['message' => 'Token confirmado', 400]);
    }

}
