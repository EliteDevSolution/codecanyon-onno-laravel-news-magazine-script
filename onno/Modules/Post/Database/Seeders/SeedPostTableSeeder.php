<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Post;
use Faker\Factory as Faker;
use DB;

class SeedPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $faker = Faker::create('en_US');

        for($i = 1; $i <= 1; $i++) {  

            if($i == 1):
                $type                = 'article';
            else:
                $type                = 'video';
                $video_url_type      = 'mp4_url';
                $video_url           = 'http://www.caminandes.com/download/03_caminandes_llamigos_1080p.mp4';
            endif;

            if($i <= 3 ):
                $category           = 1;
                $subCategory        = 1;
            else:
                $category           = 2;
                $subCategory        = 2;
            endif;

            Post::create([
                'title'             => htmlspecialchars("Sample $type post"),
                'slug'              => htmlspecialchars($this->make_slug("sample $type post")),
                'content'           => htmlspecialchars("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
                'language'          => 'en',
                'user_id'           => '1',
                'category_id'       => $category,
                'sub_category_id'   => $subCategory,
                'post_type'         => $type,
                'visibility'        => '1',
                'status'            => '1',
                'slider'            => $i <= 2 ? 1: 0,
                'tags'              => 'politics,world',
                'featured'          => '1',
                'breaking'          => '1',
                'recommended'       => '1',
                'editor_picks'      => '1',
                'video_url_type'    => $video_url_type ?? '',
                'video_url'         => $video_url ?? ''
            ]); 

        }


        Model::unguard();

        // $this->call("OthersTableSeeder");
    }

    private function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
