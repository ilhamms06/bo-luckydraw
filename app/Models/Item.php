<?php

namespace App\Models;

use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'screen_id',
        'name',
        'image',
        'total_draw',
        'limit_per_draw'
    ];

    public function screen(){
        return $this->belongsTo(Screen::class, 'screen_id','id');
    }
}
