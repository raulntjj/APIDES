<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Team;
use App\Models\Institution;
use App\Models\Modality;
use App\Models\Score;

class Participant extends Model{
    use HasFactory;

    protected $table = 'participants';
    protected $fillable = [
        'user_id', //ID do usuário
        'team_id', //Id do time
        'institution_id', //Id da instituição
        'modality_id', //Id da modalidade
        'name', //Nome
        'lastName', //Sobrenome
        'birthday', //Data de aniversário
        'gender', //Gênero
        'position', //Posição
        'photo' //Caminho para foto do participant
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações Eloquent
    public function user(){
        return $this->belongsTo(User::class, 'participant_id');
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function institution(){
        return $this->belongsTo(Institution::class);
    }

    public function modality(){
        return $this->belongsTo(Modality::class);
    }

    public function scores(){
        return $this->belongsTo(Score::class);
    }

    public function achievements(){
        return $this->hasMany(Achievement::class, 'participant_id');
    }
}
