<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordResetToken;
use Carbon\Carbon;
use Exception;
use App\Services\UserRequest;
use App\Http\Requests\UserService;
use App\Events\AccountCreated;
use App\Models\AccountConfirmToken;

class RegisterService {

    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    //Função para registrar usuário
    public function register(UserRequest $request){
        try{
            $this->userService->addUser($request);
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function sendToken($email){
        try{
            //Gerando token aleatório
            $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

            //Disparando evento de conta criada
            AccountCreated::dispatch($email, $token);
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function confirmToken($email, $token){
        if($confirmToken = AccountConfirmToken::where('email', $email)->where('token', $token)->get()){
            //Após confirmar ele será deletado
            $confirmToken->delete();
            return true;
        } else {
            return false;
        }
    }
}
