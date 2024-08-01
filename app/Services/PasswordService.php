<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordResetToken;
use App\Events\PasswordResetRequest;
use Carbon\Carbon;
use Exception;

class PasswordService{
    public function __construct(){
        $this->deleteExpiredTokens();
    }

    public function deleteExpiredTokens(){
        PasswordResetToken::where('expires_at', '<', Carbon::now())->delete();
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
            //Enviando token de redifinição
            PasswordResetRequest::dispatch($email, $token);
            return response()->json(['Success' => 'Token submitted']);
        } catch (Exception $e){
            return response()->json(['Error' => 'Failed to submit token', 'Details' => $e->getMessage()]);
        }
    }

    public function findResetToken($request){
        try{
            PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first();
            return response()->json(['Success' => 'Token confirmated']);
        } catch (Exception $e){
            return response()->json(['Error' => 'Failed to confirmate token', 'Details' => $e->getMessage()]);
        }
    }

    public function changePassword($password, User $user){
        try{
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['Success' => 'Password changed']);
        } catch (Exception $e){
            return response()->json(['Error' => 'Failed to change password', 'Details' => $e->getMessage()]);
        }
    }

    public function forceChangePassword($password, User $user){
        try{
            $user->password = Hash::make($password);
            $user->save();
            //Deletando token
            PasswordResetToken::where('email', $user->email)->delete();
            return response()->json(['Success' => 'Password changed']);
        } catch (Exception $e){
            return response()->json(['Error' => 'Failed to change password', 'Details' => $e->getMessage()]);
        }
    }
}
