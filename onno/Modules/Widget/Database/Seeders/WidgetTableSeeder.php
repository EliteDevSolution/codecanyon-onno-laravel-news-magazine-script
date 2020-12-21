<?php

namespace Modules\Widget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Widget\Entities\Widget;
use DB;


class WidgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Widget::create([
            'title'         => 'Popular Posts',
            'short_code'    => 'popular_posts',
            'language'      => 'en',
            'order'         => '1',
            'is_custom'     => '1',
            'status'        => '1',
            'location'      => '1',
            'content_type'  => '1'
            ]);

        Widget::create([
            'title'         => 'Follow Us',
            'short_code'    => 'follow_us',
            'language'      => 'en',
            'order'         => '2',
            'is_custom'     => '1',
            'status'        => '1',
            'location'      => '1',
            'content_type'  => '5'
            ]);

        Widget::create([
            'title'         => 'Newsletter',
            'short_code'    => 'newletter',
            'language'      => 'en',
            'order'         => '3',
            'is_custom'     => '1',
            'status'        => '1',
            'location'      => '1',
            'content_type'  => '4'
            ]);



        Widget::create([
            'title'         => 'Popular Posts',
            'language'      => 'en',
            'order'         => '1',
            'is_custom'     => '1',
            'status'        => '1',
            'location'      => '2',
            'content_type'  => '1'
            ]);

        Widget::create([
            'title'         => 'Newsletter',
            'language'      => 'en',
            'order'         => '3',
            'is_custom'     => '1',
            'status'        => '1',
            'location'      => '2',
            'content_type'  => '4'
        ]);





        
        Model::unguard();


    }
}
