<?php

namespace app\controller\agent;

use app\controller\Controller;
use app\model\filter\ConfigFilter;
use app\service\ConfigService;
use Exception;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class ConfigController extends Controller
{
    /**
     * 获取配置
     *
     * @param $key
     * @return Response
     */
    public function info($key): Response
    {
        $info = ConfigService::instance()->getField($key);
        return Response::success($info);
    }
}
