<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model{
    use HasFactory;

    protected $table = 'achievements';
    protected $fillable = [
        'participant_id',
        'name'
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    public function participant(){
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
