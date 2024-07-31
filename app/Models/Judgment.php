<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judgment extends Model{
    use HasFactory;
    protected $table = 'judgments';
    protected $fillable = [
        'evaluation_id',
        'item_id',
        'attempt',
        'correct_attempt',
        'fail_attempt',
        'score',
    ];

    /*
    Descomente caso queria retirar as datas de criação e edição do retorno dos dados em Json
    protected $hidden = [
        //'created_at',
        //'updated_at'
    ];
    */

    //Relações eloquent
    public function evaluation(){
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
