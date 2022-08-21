<?php

namespace App\Models;
use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'sprint_type',
        'background',
        'unique_field',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
