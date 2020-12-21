<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedSettingsTableSeeder::class);
        $this->call(SeedEmailTemplatesTableSeeder::class);
        // $this->call(EmailTemplateTableSeeder::class);
        Model::unguard();
    }
}
