<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Participant;

class Team extends Model{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'name', //Nome do time
        'logo' //Caminho para logo do time
    ];

    //Relacionamentos eloquent
    public function participant(){
        return $this->hasMany(Participant::class);
    }
}
