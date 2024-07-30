<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Model\Evaluation;
use App\Model\User;

class SubCriterion extends Model{
    use HasFactory;
    protected $table = 'sub_criteria';
    protected $fillable = [
        'criterion_id',
        'name', //Nome do subcritério
        'points' //Pontos do subcritério
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

    public function criterion(){
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }

    public function items(){
        return $this->hasMany(Item::class, 'subCriterion_id');
    }
}
