<?php

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Page\Entities\Page;
use Faker\Factory as Faker;


class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');

        Page::create([
            "title"         =>'Contact Us',
            "language"      => "en",
            "page_type"     => "2",
            "slug"          => "contact-us",
            "template"      => "1",
            "visibility"    => "1",
            "show_title"    => "1",
            "show_breadcrumb" => "1",
            "description" => htmlspecialchars($faker->realText(3000))
        ]);

        Page::create([
            "title"         =>'About Us',
            "language"      => "en",
            "page_type"     => "1",
            "slug"          => "about-us",
            "template"      => "1",
            "visibility"    => "1",
            "show_title"    => "1",
            "show_breadcrumb" => "1",
            "description" => htmlspecialchars($faker->realText(3000))
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }

    private function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
