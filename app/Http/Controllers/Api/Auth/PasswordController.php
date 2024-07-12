<?php

namespace App\Http\Controllers\Api\Auth;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Services\PasswordService;

class PasswordController{
    protected $passwordService;

    public function __construct(PasswordService $passwordService){
        $this->passwordService = $passwordService;
    }

    // Método para troca de senha
    public function changePassword(Request $request){
        if(!($request->new_password === $request->new_password_confirmation)){
            return response()->json(['error' => 'As senhas digitadas não coincidem'], 400);
        }
        //Verificando usuário autenticado com o token recebido
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Usuário não existente'], 404);
        }

        //Validando se senha antiga é correspondente
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Senha antiga incorreta'], 400);
        }

        //Trocando senha
        if(!$this->passwordService->changePassword($request->new_password, $user)){
            return response()->json(['error' => 'Não foi possivel aterar senha'], 500);
        }

        return response()->json(['message' => 'Senha alterada com sucesso'], 200);
    }

    //Método para enviar token via email
    public function forgotPassword(Request $request){
        //Validando exitencia do email
        if(!$this->passwordService->emailValidation($request)){
            return response()->json(['error' => 'email'], 404);
        }

        //Gerando token aleatório
        $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

        //Se ocorrer um erro ao criar token
        if(!$this->passwordService->createResetToken($request->email, $token)){
            return response()->json(['error' => 'Token já enviado, revise nas suas caixas de entrada e SPAM do email, ou aguarde um tempo para fazer a solicitação de um novo token'], 400);
        }

        //Se ocorrer um erro ao enviar token
        if(!$this->passwordService->sendResetToken($request->email, $token)){
            return response()->json(['error' => 'server'], 500);
        }

        return response()->json(['message' => 'Código de redefinição enviado com sucesso'], 200);
    }

    //Metodo para resetar senha
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);
        //Validando request
        if ($validator->fails()) {
            return response()->json(['error' => 'password'], 422);
        }

        //Validando existência do email e retornando usuário caso exista
        if (!$user = $this->passwordService->emailValidation($request)) {
            return response()->json(['error' => 'email'], 404);
        }

        //Verificando existência do token
        if(!$this->passwordService->findResetToken($request)){
            return response()->json(['error' => 'token'], 400);
        }

        //Alterando senha
        if(!$this->passwordService->forceChangePassword($request->password, $user)){
            return response()->json(['error' => 'server'], 500);
        }

        return response()->json(['message' => 'Senha redefinida com sucesso'], 200);
    }
}
