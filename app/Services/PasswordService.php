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

class PasswordService{
    public function __construct(){
        $this->deleteExpiredTokens();
    }
    //Função para validar se possui email
    public function emailValidation(Request $request){
        try {
            $user = User::where('email', $request->email)->first();
            if($user){
                return $user;
            } else{
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    private function deleteExpiredTokens(){
        PasswordResetToken::where('expires_at', '<', Carbon::now())->delete();
    }

    public function createResetToken($email, $token){
        try{
            if(PasswordResetToken::updateOrCreate(['email' => $email], ['token' => $token, 'created_at' => Carbon::now()])){
                return true;
            } else{
                return false;
            }
        } catch (Exception $e){
            return false;
        }
    }

    public function sendResetToken($email){
        try{
            $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            Mail::send('emails.password_reset', ['token' => $token], function($message) use ($email) {
                $message->to($email);
                $message->subject('Código de Redefinição de Senha');
            });
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function findResetToken($request){
        try{
            if(PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first()){
                return true;
            }
        } catch (Exception $e){
            return false;
        }
    }

    public function changePassword($password, User $user){
        try{
            $user->password = Hash::make($request->password);
            $user->save();
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function forceChangePassword($password, User $user){
        try{
            $user->password = Hash::make($password);
            $user->save();
            //Deletando token
            PasswordResetToken::where('email', $user->email)->delete();
            return true;
        } catch (Exception $e){
            return false;
        }
    }
}
