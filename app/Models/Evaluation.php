<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model{
    use HasFactory;
    protected $table = 'evaluations';
    protected $fillable = [
        'participant_id',
        'eventDay_id',
        'modality_id',
        'judge_id',
        'date',
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações Eloquent
    public function participant(){
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function judge(){
        return $this->belongsTo(User::class, 'judge_id');
    }

    public function eventDay(){
        return $this->belongsTo(EventDay::class, 'eventDay_id');
    }

    public function modality(){
        return $this->belongsTo(Modality::class, 'modality_id');
    }

    public function judgments(){
        return $this->hasMany(Judgment::class, 'evaluation_id');
    }

    // public function criterion(){
    //     return $this->belongsTo(Criterion::class, 'criterion_id');
    // }

    // public function subCriterion(){
    //     return $this->belongsTo(SubCriterion::class, 'subCriterion_id');
    // }

    // public function item(){
    //     return $this->belongsTo(Item::class, 'item_id');
    // }
}
