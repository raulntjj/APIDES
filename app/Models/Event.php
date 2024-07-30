<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EventAddress;
use App\Models\EventDayAddress;
 

class Event extends Model{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'name', //Nome do evento
        'logo' //Logo do evento
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relacionamentos eloquent
    public function address(){
        //Declarando cardinalidade um para um com Endereços
        /*
            Obs: se necessário, é possível alterar a cardinalidade de um para muitos.
        */
        return $this->hasOne(EventAddress::class);
    }

    public function days(){
        return $this->hasMany(EventDay::class);
    }
}
