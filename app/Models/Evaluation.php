<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model{
    use HasFactory;
    protected $table = 'evaluations';
    protected $fillable = [
        'participant_id',
        'event_day_id',
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
        return $this->belongsTo(EventDay::class, 'event_day_id');
    }

    public function modality(){
        return $this->belongsTo(Modality::class, 'modality_id');
    }

    public function judgments(){
        return $this->hasMany(Judgment::class, 'evaluation_id');
    }
}
