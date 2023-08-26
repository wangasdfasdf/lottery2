<?php
namespace app\controller\admin;

use app\controller\Controller;
use app\model\filter\AgentWalletPaymentLogFilter;
use app\service\AgentWalletPaymentLogService;
use Exception;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentWalletPaymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AgentWalletPaymentLogFilter $filter
     * @return Response
     */
    public function index(Request $request, AgentWalletPaymentLogFilter $filter): Response
    {
        $data = AgentWalletPaymentLogService::instance()->getResourceList($filter, $request, []);

        return Response::success($data);
    }

}
