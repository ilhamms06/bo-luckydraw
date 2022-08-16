<?php

namespace App\Models;
use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
    ];


    public function project(){
        return $this->belongsTo(Project::class, 'project_id','id');
    }

    public function screen(){
        return $this->hasMany(Item::class, 'id','screen_id');
    }
}
