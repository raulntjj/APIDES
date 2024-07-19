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

    private function deleteExpiredTokens(){
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
            return response()->json(['success' => 'token submitted']);
        } catch (Exception $e){
            return response()->json(['error' => 'failed to submit token', ['details' => $e->getMessage()]]);
        }
    }

    public function findResetToken($request){
        try{
            PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first();
            return response()->json(['success' => 'token confirmated']);
        } catch (Exception $e){
            return response()->json(['error' => 'failed to confirmate token', ['details' => $e->getMessage()]]);
        }
    }

    public function changePassword($password, User $user){
        try{
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success' => 'password changed']);
        } catch (Exception $e){
            return response()->json(['error' => 'failed to change password', ['details' => $e->getMessage()]]);
        }
    }

    public function forceChangePassword($password, User $user){
        try{
            $user->password = Hash::make($password);
            $user->save();
            //Deletando token
            PasswordResetToken::where('email', $user->email)->delete();
            return response()->json(['success' => 'password changed']);
        } catch (Exception $e){
            return response()->json(['error' => 'failed to change password', ['details' => $e->getMessage()]]);
        }
    }
}
