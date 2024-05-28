<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Model\Evaluation;
use App\Model\User;

class SubCriterion extends Model{
    use HasFactory;
    protected $table = 'sub_criteria';
    protected $fillable = [
        'name', //Nome do subcritério
        'points' //Pontos do subcritério
    ];

    //Relações eloquent
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }

    public function schedules(){
        return $this->hasMany(User::class);
    }
}
