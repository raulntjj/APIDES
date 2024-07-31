<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model{
    use HasFactory;
    protected $table = 'criteria';
    protected $fillable = [
        'name', //Nome do critério
        'points' //Pontos do critério
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações eloquent
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function subcriteria(){
        return $this->hasMany(Subcriterion::class, 'criterion_id');
    }
}
