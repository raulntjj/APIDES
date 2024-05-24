<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Event;

class EventAddress extends Model{
    use HasFactory;
    protected $table = 'event_addresses';
    protected $fillable = [
        'address', //Rua avenida, etc...
        'number', //Número do logradouro
        'neighborhood', //Bairro
        'city', //Cidade
        'state', //Estado
        'country', //País
        'cep' //código postal (CEP)
    ];

    //Relacionamentos eloquent
    public function event(){
        //Declarando pertencença a entidade evento
        return $this->belongTo(Event::class);
    }
}
