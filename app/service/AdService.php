<?php

namespace app\service;

use app\enum\StatusEnum;
use app\model\Ad;

class AdService extends BaseService
{
    public $model = 'app\model\Ad';

    public function frontAll()
    {
        return Ad::query()->where('status', StatusEnum::ENABLE)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->get();
    }
}
