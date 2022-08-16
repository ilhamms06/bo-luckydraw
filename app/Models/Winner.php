<?php

namespace App\Models;
use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'participants_id',
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id','id');
    }

    public function participant(){
        return $this->belongsTo(Participant::class, 'participants_id','id');
    }
}
