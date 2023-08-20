<?php

namespace app\model\abstract;


use Illuminate\Database\Eloquent\Builder;
use support\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected Request $request;
    protected $builder;


    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {

            if (!$this->isFilterValue($value)) {
                continue;
            }

            $name = Str::camel($name);

            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
    }

    /**
     * 过滤空值查询
     *
     * @param $value
     * @return bool
     */
    public function isFilterValue($value)
    {
        return $value !== '' && $value !== null && !empty($value);
    }


    public function filters(): array
    {
        return \request()->all();
    }
}
