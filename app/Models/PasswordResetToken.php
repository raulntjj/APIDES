<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordResetToken extends Model{

    protected $fillable = [
        'email',
        'token',
        'created_at',
        'expires_at',
    ];

    public $timestamps = false;

    public static function boot(){
        parent::boot();

        static::creating(function ($token) {
            $token->created_at = Carbon::now();
            $token->expires_at = Carbon::now()->addMinutes(5);
        });
    }

    // Verificar se o token ainda é válido
    public function isValid(){
        return Carbon::now()->lt($this->expires_at);
    }
}
