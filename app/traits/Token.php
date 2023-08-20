<?php

namespace app\traits;

use Illuminate\Database\Eloquent\Model;
use Shopwwi\LaravelCache\Cache;


trait Token
{
    /**
     * 获取token
     *
     * @param Model $model
     * @param array $data
     * @return string
     */
    public function getToken(Model $model, array $data = []): string
    {
        $token = md5($model->id . time() . mt_rand(0, 99999)) . $model->getTable();

        $this->setCache($token, $model, $data);

        return $token;
    }

    public function setCache($token, Model $model, array $data): void
    {
        Cache::put($token, array_merge([
            'token' => $token,
            'model_id' => $model->id,
            'create_time' => time(),
            'table' => $model->getTable(),
        ], $data), 86400);

    }

    /**
     * 检查token
     * @param string $token
     * @return mixed
     */
    public function checkToken(string $token): mixed
    {
        return Cache::get($token);
    }

    public function deleteToken(string $token): void
    {
        Cache::forget($token);
    }
}
