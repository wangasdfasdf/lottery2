<?php

namespace app\service;

use app\model\abstract\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use support\exception\TipsException;

class BaseService
{
    private static array $instances = [];

    /**
     * @var Model $model
     */
    public $model;

    public static function instance(): static
    {
        $name = static::class;
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = new $name();
        }
        return self::$instances[$name];
    }

    /**
     * 获取分页列表
     *
     * @param QueryFilter $filter
     * @param $request
     * @param array $with
     * @param array $append
     * @return mixed
     */
    public function getResourceList(QueryFilter $filter, $request, array $with = []): mixed
    {
        $num     = $request->input('num', 10);
        $orderBy = $request->input('order_by', 'id');
        $sort    = $request->input('sort', 'desc');

        $data = $this->model::with($with)->filter($filter)->orderBy($orderBy, $sort)->paginate($num);

        return [
            'list'         => $data->items(),
            'total'        => $data->total(),
            'current_page' => $data->currentPage(),
            'num'          => $num,
        ];
    }

    /**
     * 获取单条数据
     *
     * @param int $id
     * @param string[] $columns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id, array $columns = ['*'])
    {
        return $this->model::query()->find($id);
    }

    /**
     * 创建数据
     *
     * @param array $attribute
     * @return mixed
     * @throws \Exception
     */
    public function create(array $attribute): mixed
    {
        try {
            $model = new $this->model;
            $model->fill($attribute);
            $model->save();
            return $model;
        } catch (\Throwable $th) {
            $this->throw($th->getMessage());
        }
    }

    /**
     * 更新模型
     *
     * @param int $id
     * @param array $attribute
     * @return Builder|Builder[]|Collection|Model|null
     * @throws TipsException
     */
    public function updateById(int $id, array $attribute): Model|Collection|Builder|array|null
    {
        try {
            $model = $this->model::query()->findOrFail($id);
            $model->fill($attribute);
            $model->save();
            return $model;
        } catch (\Throwable $th) {
            $this->throw($th->getMessage());
        }

    }

    /**
     * 删除模型
     *
     * @param int $id
     * @return bool
     * @throws TipsException
     */
    public function deleteById(int $id): bool
    {
        try {
            $model = $this->model::query()->findOrFail($id);
            $model->delete();
            return true;
        } catch (\Throwable $th) {
            $this->throw($th->getMessage());
        }
    }


    /**
     * 抛出异常
     *
     * @param null $responseMessage
     * @param null $responseCode
     * @return null
     * @throws TipsException
     */
    protected function throw($responseMessage = null, $responseCode = null)
    {
        // 如果没有传入错误代码，则错误代码为5001
        $responseCode = $responseCode ?? 5001;

        // 如果没传入错误信息
        $responseMessage = $responseMessage ?? trans('system.error');

        // 抛出异常
        throw new TipsException($responseMessage, $responseCode);
    }
}