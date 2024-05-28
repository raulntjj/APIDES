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
        'index' //'Index' faz alusão ao índice da data acima ex: primeiro dia, segunda dia, etc...
    ];

    //Relacionamentos eloquent
    public function event(){
        //Declarando pertencença a entidade evento
        return $this->belongsTo(Event::class);
    }
}
