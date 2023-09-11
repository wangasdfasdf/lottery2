<?php

namespace database\seeders;

use app\enum\ConfigKey;
use app\model\Config;
use Eloquent\Migrations\Seeds\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Config::query()->firstOrCreate(['key' => ConfigKey::U2Day2], ['name' => 'U转天数', 'value' => 2]);
        Config::query()->firstOrCreate(['key' => ConfigKey::DEFAULT_DOMAIN], ['name' => '默认域名', 'value' => 'http://tianxin.jcprint.vip/machine']);
        Config::query()->firstOrCreate(['key' => ConfigKey::DOMAIN_LISTS], ['name' => '域名列表', 'value' => 'http://tianxin.jcprint.vip/machine,http://tanzan.jcprint.vip,http://ss.jcprint.vip']);
    }
}
