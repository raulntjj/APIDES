<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model{
    use HasFactory;
    protected $table = 'scores';
    protected $fillable = [
        'evaluation_id', //Id da avaliação
        'participant_id', //Id do participante
        'points' //Pontuação
    ];


    //Relações Eloquent
    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }

    public function participant(){
        return $this->belongsTo(Participant::class);
    }
}
