<?php

namespace Modules\Ads\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ads\Entities\Ad;
use Faker\Factory as Faker;
use DB;

class SeedAdsTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();
    }
}
   