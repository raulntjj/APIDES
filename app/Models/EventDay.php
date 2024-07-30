<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Event;

class EventDay extends Model{
    use HasFactory;
    protected $fillable = [
        'event_id', //índice do event
        'date', //'date' faz referência a data do evento
        'startHour', //Hora de inicio do evento
        'index' //'Index' faz alusão ao índice da data acima ex: primeiro dia, segunda dia, etc...
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relacionamentos eloquent
    public function event(){
        //Declarando pertencença a entidade evento
        return $this->belongsTo(Event::class);
    }

    public function avaliations(){
        return $this->hasMany(Avaliation::class, 'eventDays_id');
    }
}
