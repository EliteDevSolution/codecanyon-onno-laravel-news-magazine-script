<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Poll;
use Modules\Post\Entities\PollOption;
use Faker\Factory as Faker;

class SeedPollTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Poll::create([
            'question'      => 'How are you?',
            'start_date'   => date('Y-m-d H:i:s'),
            'end_date'    => date('Y-m-d H:i:s', strtotime('+5 days')),
            'auth_required'    => 0,
            'status'    => 1
        ]);

        PollOption::create([
            'poll_id'      => 1,
            'option'   => 'Fine',
            'order'    => 0
        ]);

        PollOption::create([
            'poll_id'      => 1,
            'option'   => 'Bad',
            'order'    => 1
        ]);

        Model::unguard();
    }
}