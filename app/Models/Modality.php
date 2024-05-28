<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model{
    use HasFactory;
    protected $table = 'modalities';
    protected $fillable = [
        'name', //Nome da modalidade
        'type' //Tipo de modalidade
    ];

    //Relacionamentos eloquent
    public function participants(){
        return $this->hasMany(Participant::class);
    }

    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }
}
