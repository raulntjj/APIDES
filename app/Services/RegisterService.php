<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordResetToken;
use Carbon\Carbon;
use Exception;
use App\Services\UserRequest;
use App\Http\Requests\UserService;

class RegisterService{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function register(UserRequest $request){
        if(!$this->userService->addUser($request)){
            return false;
        }
    }

    public function sendToken($email){
        try{
            $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            Mail::send('emails.token_confirmation', ['token' => $token], function($message) use ($email) {
                $message->to($email);
                $message->subject('Código de confirmação de conta');
            });
            return true;
        } catch (Exception $e){
            return false;
        }
    }
}
