<?php

namespace app\command;

use app\enum\QueueKey;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentOrder;
use app\model\AgentShop;
use app\service\AgentOrderService;
use app\service\AgentService;
use app\service\AgentShopWalletPaymentLogService;
use app\service\AgentWalletPaymentLogService;
use app\service\LotteryBdResultService;
use app\service\LotteryBdSfResultService;
use app\service\LotteryJcResultService;
use app\service\LotteryJcService;
use app\service\LotteryPlsResultService;
use app\service\LotteryPlwResultService;
use app\service\OssService;
use app\service\RasService;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use support\Db;
use support\Log;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\RedisQueue\Redis;


class Tests extends Command
{
    use SetSuffix;

    protected static $defaultName = 'tests';
    protected static $defaultDescription = 'Tests';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $agentId = 2;

        /**
         * @var Agent $agent
         */
        $agent = Agent::query()->find($agentId);

        $path1 = "/home/wwwroot/linux-client-package/attach/core.dat";
        $tag = $agent->tag;
        file_put_contents($path1, $tag);
        $command = 'cd /home/wwwroot/linux-client-package && node build/builder.js';
        exec($command, $output);

        Log::info('111111', $output);
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

        dd(1);
        return self::SUCCESS;
    }

}
