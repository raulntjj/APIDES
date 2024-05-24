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
        'dateTime', //Data e hora de inicio
        'eventLogo' //Logo do evento
    ];

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
