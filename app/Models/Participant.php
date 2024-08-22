<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model{
    use HasFactory;

    protected $table = 'participants';
    protected $fillable = [
        'user_id', //ID do usuário
        'team_id', //Id do time
        'institution_id', //Id da instituição
        'modality_id', //Id da modalidade
        'position',
    ];

    protected $appends = [
        'category'
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
        return $this->belongsTo(User::class, 'user_id');
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

    public function getCategoryAttribute(){
        $age = -now()->diffInYears(\Carbon\Carbon::parse($this->user->birthday));

        if ($age <= 7) {
            return 'Sub-7';
        } elseif ($age <= 9) {
            return 'Sub-9';
        } elseif ($age <= 11) {
            return 'Sub-11';
        } elseif ($age <= 13) {
            return 'Sub-13';
        } elseif ($age <= 15) {
            return 'Sub-15';
        } elseif ($age <= 17) {
            return 'Sub-17';
        } elseif ($age <= 19) {
            return 'Sub-19';
        } elseif ($age <= 21) {
            return 'Sub-21';
        } elseif ($age <= 23) {
            return 'Sub-23';
        } else {
            return 'Undefined';
        }
    }
}
