<?php

namespace app\model;

use app\model\traits\QueryFilterTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use QueryFilterTrait;


    protected $hidden = [
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}