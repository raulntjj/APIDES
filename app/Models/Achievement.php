<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model{
    use HasFactory;

    protected $table = 'achievements';
    protected $fillable = [
        'participant_id',
        'name'
    ];

    public function user(){
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
