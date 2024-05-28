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

    //Relacionamentos eloquent
    public function participant(){
        return $this->hasMany(Participant::class);
    }
}
