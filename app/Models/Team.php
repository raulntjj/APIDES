<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Participant;

class Team extends Model{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'name', //Nome do time
        'logo' //Caminho para logo do time
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relacionamentos eloquent
    public function participants(){
        return $this->hasMany(Participant::class);
    }
}
