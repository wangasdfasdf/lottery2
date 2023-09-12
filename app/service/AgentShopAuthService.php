<?php

namespace app\service;

use app\enum\ConfigKey;
use app\enum\StatusEnum;
use app\model\AgentShop;
use app\model\Config;
use app\traits\Token;
use support\exception\TipsException;

class AgentShopAuthService extends BaseService
{
    use Token;

    public $model = 'app\model\AgentShop';

    /**
     * 登录
     *
     * @param $LoginName
     * @param $password
     * @param $machine_id
     * @return AgentShop
     * @throws TipsException
     */
    public function login($LoginName, $password, $machine_id): AgentShop
    {
        /**
         * @var AgentShop $shop
         */
        $shop = AgentShop::query()->where('login_name', $LoginName)->first();

        if (empty($shop)) {
            $this->throw('账号错误');
        }

        if (!passwordVerify($password, $shop->password)) {
            $this->throw('密码错误');
        }

        if (StatusEnum::DISABLE->value == $shop->status) {
            $this->throw('账号已被禁用,请联系管理员');
        }


        if (empty($shop->machine_id)) {

            $domeLists = Config::query()->where('key', ConfigKey::DOMAIN_LISTS)->value('value');
            $domainList = explode(',', $domeLists);
            $domain = $domainList[array_rand($domainList)];
            $shop->machine_id = $machine_id;
            $shop->domain = $domain;
            $shop->save();

            $object = 'machine/'.$shop->machine_id;
            $content = '{"domain":"' . $domain . '"}';
            $content = RasService::instance()->privateEncode($content);
            OssService::instance()->put($object, $content);

        }

        if ($shop->machine_id != $machine_id) {
            $this->throw('请原设备登录');
        }

        $this->deleteToken($shop->token);

        $shop->token = $this->getToken($shop, ['machine_id' => $shop->machine_id]);
        $shop->save();

        return $shop;
    }


}
