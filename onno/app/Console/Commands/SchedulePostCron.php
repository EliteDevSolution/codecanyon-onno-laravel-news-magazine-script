<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Post\Entities\Post;
use DB;
use Modules\Common\Entities\Cron;

class SchedulePostCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature    = 'schedulepost:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description  = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts  = Post::where('scheduled', 1)->where('scheduled_date', '<=', date('Y-m-d H:i:s'))->get();

        \Log::info($posts);
        foreach ($posts as $post) :
            $update_status  = Post::find($post->id);

            $update_status->scheduled   = 0;
            $update_status->status      = 1;

            $update_status->save();
        endforeach;

    }
}
