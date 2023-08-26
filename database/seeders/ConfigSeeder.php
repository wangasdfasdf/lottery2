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
    }
}
