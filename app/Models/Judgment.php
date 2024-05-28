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

    //Relações eloquent
    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
