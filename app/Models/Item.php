<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Evaluation;
use App\Models\Judgment;

class Item extends Model{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'name', //Nome do item
        'score', //Pontuação do item
        'aspect' //Aspecto do item
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações Eloquent
    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }

    public function judgments(){
        return $this->hasMany(Judgment::class);
    }
}
