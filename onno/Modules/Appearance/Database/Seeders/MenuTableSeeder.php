<?php

namespace Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Appearance\Entities\Menu;
use Modules\Appearance\Entities\MenuLocation;
use DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Menu::create(['title' => 'Primary Menu']);

        // MenuLocation::create(['title' => 'Top','unique_name' => 'top','menu_id'=>1]);
        MenuLocation::create(['title' => 'Primary','unique_name' => 'primary','menu_id'=>1]);
        // MenuLocation::create(['title' => 'Footer','unique_name' => 'footer','menu_id'=>3]);
    }
}
