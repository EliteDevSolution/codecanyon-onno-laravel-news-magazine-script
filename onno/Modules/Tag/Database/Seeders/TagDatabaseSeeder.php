<?php

namespace Modules\Tag\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Entities\Tag;

class TagDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Tag::create(['title'=> 'Sports','total_hit' => 10]);
        Tag::create(['title'=> 'Football','total_hit' => 12]);
        Tag::create(['title'=> 'Cricket','total_hit' => 10]);
        Tag::create(['title'=> 'Education','total_hit' => 10]);
        Tag::create(['title'=> 'Business','total_hit' => 10]);
        Tag::create(['title'=> 'Technology','total_hit' => 10]);
        Tag::create(['title'=> 'Science','total_hit' => 10]);
        Tag::create(['title'=> 'Bangladesh','total_hit' => 2]);
        Tag::create(['title'=> 'World Cup','total_hit' => 10]);
        Tag::create(['title'=> 'Politics','total_hit' => 6]);
        Tag::create(['title'=> 'Computer','total_hit' => 2]);
        Tag::create(['title'=> 'Apple','total_hit' => 3]);
        Tag::create(['title'=> 'Microsoft','total_hit' => 3]);
        Tag::create(['title'=> 'Google','total_hit' => 4]);
        Tag::create(['title'=> 'Travel','total_hit' => 10]);
        Tag::create(['title'=> 'Virus','total_hit' => 10]);
        Tag::create(['title'=> 'Culture','total_hit' => 10]);
        Tag::create(['title'=> 'Culture','total_hit' => 10]);
        Tag::create(['title'=> 'Health','total_hit' => 10]);
        Tag::create(['title'=> 'Tree','total_hit' => 5]);
        Tag::create(['title'=> 'Environment','total_hit' => 8]);
        Tag::create(['title'=> 'Pollution','total_hit' => 6]);

        // $this->call("TagTableSeeder");
    }
}
