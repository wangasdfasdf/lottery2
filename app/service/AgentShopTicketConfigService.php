<?php

namespace app\service;

use app\model\AgentShopTicketConfig;

class AgentShopTicketConfigService extends BaseService
{
    public $model = 'app\model\AgentShopTicketConfig';

    public function createOrUpdate(mixed $data)
    {
        $shop_id = $data['shop_id'];
        $type = $data['type'];

        /**
         * @var AgentShopTicketConfig $shop_config
         */
        $shop_config = AgentShopTicketConfig::query()->firstOrCreate(compact('shop_id', 'type'), []);
        $shop_config->fill($data);
        $shop_config->save();
    }
}
