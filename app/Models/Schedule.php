<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubCriterion;
use App\Models\User;

class Schedule extends Model{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'subCriterion_id', //Sub critério
        'date', //Data da avaliação
        'judge_id' //Id o usário jurado
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações eloquent
    public function subCriterion(){
        return $this->belongsTo(SubCriterion::class, 'subCriterion_id');
    }

    public function judge(){
        return $this->belongsTo(User::class);
    }
}
