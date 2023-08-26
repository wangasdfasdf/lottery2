<?php

namespace app\controller\shop;

use app\controller\Controller;
use app\service\AgentShopService;
use support\exception\TipsException;
use support\Request;
use support\Response;

class AgentShopController extends Controller
{

    public function info(Request $request): Response
    {
        $shopId = $request->input('shop_id');

        $info = AgentShopService::instance()->getById($shopId);

        return Response::success($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws TipsException
     */
    public function update(Request $request): Response
    {
        $data = $request->only(['shop_id', 'name', 'password', 'print_type', 'order_prefix', 'address', 'bottom_code']);
        $shop = $request->input('shop_id');

        if (isset($data['password']) && $data['password']) {
            $data['password'] =passwordHash($data['password']);
        }


        AgentShopService::instance()->updateById($shop, $data);

        return Response::success();
    }

    public function addAddress(Request $request): Response
    {
        $shop_id = $request->input('shop_id');

        $shop = AgentShopService::instance()->setWalletAddress($shop_id);

        return Response::success($shop);
    }

}
