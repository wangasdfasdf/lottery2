<?php

namespace app\model;

use app\model\traits\QueryFilterTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use QueryFilterTrait;


    protected $hidden = [
        'deleted_at',
    ];
}