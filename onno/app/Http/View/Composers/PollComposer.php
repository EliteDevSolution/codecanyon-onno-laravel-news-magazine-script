<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Post\Entities\Poll;
use LaravelLocalization;

class PollComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $polls  = Poll::with('pollResults', 'pollOptions.pollresults')
                    ->where('status', 1)
                    ->where('start_date', '<=', date('Y-m-d H:i:s'))
                    ->where('end_date', '>=', date('Y-m-d H:i:s'))
                    ->get();

        $view->with('polls', $polls);
    }
}
