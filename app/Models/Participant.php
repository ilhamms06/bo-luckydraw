<?php

namespace App\Models;
use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'screen_id',
        'item_id',
        'code',
        'name',
        'email',
        'phone',
        'branch',
        'province',
        'city',
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'project_id','id');
    }

    public function screen(){
        return $this->belongsTo(Screen::class, 'screen_id','id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id','id');
    }
}
