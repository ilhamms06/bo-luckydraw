<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use Uuids, SoftDeletes;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;
    // protected $dateFormat = 'Y-m-d H:i:sO';
}