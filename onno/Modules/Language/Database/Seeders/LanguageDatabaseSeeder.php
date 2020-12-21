<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LanguageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(LanguageTableSeeder::class);
        $this->call(LanguageConfigsTableSeeder::class);
		$this->call(SeedFlagIconsTableSeeder::class);
    }
}
