<?php

namespace database\seeders;

use app\enum\ConfigKey;
use app\middleware\traits\SetSuffix;
use app\model\Agent;
use app\model\AgentConfig;
use Eloquent\Migrations\Seeds\Seeder;

class AgentConfigSeeder extends Seeder
{
    use SetSuffix;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $agents = Agent::query()->get();

        /**
         * @var Agent $agent
         */
        foreach ($agents as $agent) {
            $this->setSuffix($agent->id);

            AgentConfig::query()->firstOrCreate(['key' => ConfigKey::U2Day2], ['name' => 'U转天数', 'value' => 2]);
        }
    }
}
