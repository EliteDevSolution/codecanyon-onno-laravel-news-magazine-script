<?php

namespace Modules\Appearance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Appearance\Entities\MenuItem;
use DB;

class SeedMenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("INSERT INTO `menu_item` (`id`, `label`, `language`, `menu_id`, `is_mega_menu`, `order`, `parent`, `source`, `url`, `page_id`, `category_id`, `post_id`, `status`, `new_teb`, `created_at`, `updated_at`) VALUES
            (1, 'Home', 'en', 1, 'no', 1, NULL, 'custom', '#', NULL, NULL, NULL, 1, 0, '2020-10-14 23:26:41', '2020-10-14 23:33:06'),
            (2, 'Life Style', 'en', 1, 'tab', 2, NULL, 'custom', NULL, NULL, NULL, NULL, 1, 0, '2020-10-14 23:33:29', '2020-10-14 23:36:20'),
            (3, 'World', 'en', 1, 'no', 3, 2, 'category', NULL, NULL, 1, NULL, 1, 0, '2020-10-14 23:33:38', '2020-10-14 23:35:41'),
            (6, 'Contact Us', 'en', 1, 'no', 15, NULL, 'page', NULL, 1, NULL, NULL, 1, 0, '2020-10-14 23:34:07', '2020-10-14 23:42:40'),
            (16, 'About us', 'en', 1, 'no', 14, NULL, 'page', NULL, 2, NULL, NULL, 1, 0, '2020-10-14 23:42:29', '2020-10-14 23:42:40')");

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
