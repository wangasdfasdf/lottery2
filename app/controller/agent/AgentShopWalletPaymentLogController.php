<?php
namespace app\controller\agent;

use app\controller\Controller;
use app\model\filter\AgentShopWalletPaymentLogFilter;
use app\service\AgentShopWalletPaymentLogService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentShopWalletPaymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentShopWalletPaymentLogFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentShopWalletPaymentLogFilter $filter): Response
    {
        $data = AgentShopWalletPaymentLogService::instance()->getResourceList($filter, $request, []);

        return Response::success($data);
    }
    
}
