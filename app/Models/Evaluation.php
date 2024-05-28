<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Event;
use App\Models\Modality;
use App\Models\Criterion;
use App\Models\SubCriterion;
use App\Models\Item;
use App\Models\Judgment;

class Evaluation extends Model{
    use HasFactory;
    protected $table = 'evaluations';
    protected $fillable = [
        'event_id', //Id do evento
        'modality_id', //Id da modalidade
        'criterion_id', //id do critério
        'sub_criterion_id', //id do sub-critério
        'item_id', //id dos itens
        'judgment_id' //id do Julgamento
    ];

    //Relações Eloquent
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function modality(){
        return $this->belongsTo(Modality::class);
    }

    public function criterion(){
        return $this->belongsTo(Criterion::class);
    }

    public function sub_criterion(){
        return $this->belongsTo(SubCriterion::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function judgment(){
        return $this->belongsTo(Judgment::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }
}
