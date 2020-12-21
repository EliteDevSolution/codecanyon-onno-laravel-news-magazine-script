<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PostDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SeedCategoryTableSeeder::class);
        $this->call(SeedSubCategoryTableSeeder::class);
        $this->call(SeedPostTableSeeder::class);
        $this->call(SeedPollTableSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}
