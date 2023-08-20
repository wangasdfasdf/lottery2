<?php

namespace app\model\traits;


use app\model\abstract\QueryFilter;

trait QueryFilterTrait
{
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply($query);
    }
}
