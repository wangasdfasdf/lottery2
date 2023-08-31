<?php

namespace app\controller\shop;

use app\controller\Controller;
use app\model\filter\ConfigFilter;
use app\service\AgentConfigService;
use app\service\ConfigService;
use Exception;
use Respect\Validation\Validator;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentConfigController extends Controller
{
    /**
     * 获取配置
     *
     * @param $key
     * @return Response
     */
    public function info($key): Response
    {
        $info = AgentConfigService::instance()->getField($key);
        return Response::success($info);
    }
}
