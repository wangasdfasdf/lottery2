<?php

namespace app\queue\redis;

use app\enum\QueueKey;
use app\model\Agent;
use app\service\OssService;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use support\exception\TipsException;
use Webman\RedisQueue\Consumer;

class CreateAgentClient implements Consumer
{

    public $queue = QueueKey::CREATE_AGENT_CLIENT;

    public function consume($data)
    {
        $agentId = $data['id'];

        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->find($agentId);

        $path1 = "/home/wwwroot/linux-client-package/attach/core.dat";
        $tag = $agent->tag;
        file_put_contents($path1, $tag);
        $command = 'cd /home/wwwroot/linux-client-package && node build/builder.js';
        exec($command, $output);

        if (!in_array('Build complete!', $output)) {
            throw new Exception(json_encode($output), 509);
        }


        $object = "client/" . Str::random() . '.exe';
        $path = '/home/wwwroot/linux-client-package/dist_electron/contest-client_setup_1.0.0_' . $tag . '.exe';

        $command2 = 'rm -f ' . $path;
        $command3 = 'rm -f ' . $path . '.blockmap';

        OssService::instance()->uploadFile($object, $path);

        $agent->client_url = 'https://tianxin.jcprint.vip/' . $object;
        $agent->save();

        exec($command2);
        exec($command3);

    }
}