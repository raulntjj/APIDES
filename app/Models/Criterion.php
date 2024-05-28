<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Model\Evaluation;

class Criterion extends Model{
    use HasFactory;
    protected $table = 'criteria';
    protected $fillable = [
        'name', //Nome do critério
        'points' //Pontos do critério
    ];

    //Relações eloquent
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
