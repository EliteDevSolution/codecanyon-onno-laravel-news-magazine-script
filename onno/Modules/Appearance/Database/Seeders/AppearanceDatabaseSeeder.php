<?php

namespace Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AppearanceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedThemeSectionTableSeeder::class);
        $this->call(ThemeTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(SeedMenuItemTableSeeder::class);

        Model::unguard();

    }
}
