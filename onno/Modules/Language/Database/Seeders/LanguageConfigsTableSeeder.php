<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Language\Entities\LanguageConfig;

class LanguageConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        LanguageConfig::create([
            "language_id"   =>1,
            "name"          => "English",
            "script"        => "Latn",
            "native"        => "English",
            "regional"      => "en_GB"
        ]);
        LanguageConfig::create([
            "language_id"   =>2,
            'name'          => 'Arabic',
            'script'        => 'Arb',
            'native'        => 'عربى',
            'regional'      => 'ar_AR'
        ]);
    }
}
