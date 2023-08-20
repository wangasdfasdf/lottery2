<?php
namespace app\service;

use app\model\AgentFeedback;

class AgentFeedbackService extends BaseService
{
    public $model = 'app\model\AgentFeedback';

    public function isRead(mixed $shopId): bool
    {
        return (bool)AgentFeedback::query()->where('shop_id', $shopId)->where('reply', '!=','')->where('is_read', -1)->value('id');

    }
}
