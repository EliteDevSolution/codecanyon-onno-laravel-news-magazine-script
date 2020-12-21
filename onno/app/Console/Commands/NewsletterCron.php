<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use DB;
use Modules\Common\Entities\Cron;

class NewsletterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature    = 'newsletter:cron';

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
        $crons      = Cron::where('cron_for','newsletter')->get();
        // $users= Role::where('name', 'subscriber')->first()->users()->get();
        $users      = User::where('newsletter_enable', '1')->get();

        foreach ($crons as $cron) :
            if($cron->subject != null):
                $templateBody=$cron->message;
                foreach ($users as $user) :
                    Mail::send('setting::email.email_template', [
                        'templateBody' => $templateBody
                    ], function ($message) use ($user, $cron) {
                        $message->to($user->email);
                        $message->subject($cron->subject);
                    });
                endforeach;
                $cron->delete();
            endif;
        endforeach;
    }
}
