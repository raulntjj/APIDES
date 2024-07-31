<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'sub_criterion_id',
        'name',
        'aspect',
        'weight'
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações Eloquent
    public function subcriterion(){
        return $this->belongsTo(Subcriterion::class, 'sub_criterion_id');
    }

    public function judgments(){
        return $this->hasMany(Judgment::class);
    }
}
