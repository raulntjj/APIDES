<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Schedule;

class User extends Authenticatable{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', //Nome do usuário
        'email', //Email do usuário
        'password', //Senha do usuário
        'group', //Grupo do usuário
        'interfaceLanguage', //Idioma da interface
        'photo' //Caminho para foto do usuário
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        //Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
        //'created_at',
        //'updated_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Relações eloquent
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}
