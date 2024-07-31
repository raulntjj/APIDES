<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model{
    use HasFactory;
    protected $table = 'modalities';
    protected $fillable = [
        'name', //Nome da modalidade
        'photo' //Tipo de modalidade
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relacionamentos eloquent
    public function participants(){
        return $this->hasMany(Participant::class);
    }

    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }
}
