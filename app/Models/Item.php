<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Evaluation;
use App\Models\Judgment;

class Item extends Model{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'subCriterion_id',
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
    public function subCriterion(){
        return $this->belongsTo(SubCriterion::class, 'subCriterion_id');
    }

    public function judgments(){
        return $this->hasMany(Judgment::class);
    }
}
