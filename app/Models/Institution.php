<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model{
    use HasFactory;
    protected $table = 'institutions';
    protected $fillable = [
        'name', //Nome da instituição
        'logo' //Caminho para imagem da instituição
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
}
