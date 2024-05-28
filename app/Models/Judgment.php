<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Evaluation;
use App\Models\Item;

class Judgment extends Model{
    use HasFactory;
    protected $table = 'judgments';
    protected $fillable = [
        'item_id',
        'aspect',
        'scores'
    ];

    protected $casts = [
        'scores' => 'json'
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
        return $this->belongsTo(Evaluation::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
