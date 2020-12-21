<?php

namespace Modules\Social\Database\Seeders;

use Modules\Admin\Entities\SocialMedia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SocialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
