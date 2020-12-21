<?php

namespace Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Appearance\Entities\Theme;
use Modules\Appearance\Enums\ThemeVisivilityStatus;
use DB;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $options = ["header_style"=>"header_1","footer_style"=>"footer_1","primary_color"=>"#000000","fonts"=>"Noto+Sans+JP","mode"=>null];

        Theme::create([
            'name'      => 'theme_one',
            'options'   => $options ,
            'status'    => ThemeVisivilityStatus::ACTIVE
        ]);
        Model::unguard();
    }
}
