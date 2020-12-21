<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Entities\PollResult;
use Modules\Post\Entities\Poll;
use Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use UxWeb\SweetAlert\SweetAlert;
use Cookie;

class PollController extends Controller
{
	public function savePoll(Request $request){

		if(!isset($request->option)):
	    	return redirect()->back()->with('error', __('you_have_to_select_one_option'));
        endif;

		$poll                             = Poll::find($request->poll);

		if($poll->auth_required == 1):
			if(Sentinel::getUser() == ''):
	    		return redirect()->back()->with('error', __('you_have_to_login_for_voting'));
            endif;
        endif;

		$pollResult                       = PollResult::where('poll_id', $request->poll)->where('browser_details', $request->header('user-agent'))->first();

		if(blank($pollResult)):
			$pollResult                   = new PollResult();

			$pollResult->poll_id          = $request->poll;
			$pollResult->poll_option_id   = $request->option;
			$pollResult->browser_details  = $request->header('user-agent');

			$result = $pollResult->save();
		else:
			$pollResult->poll_option_id   = $request->option;

			$result = $pollResult->save();
        endif;

		if($result):
	    	return redirect()->back()->with('success', __('vote_has_been_submitted_successfully'));
        endif;

	    return redirect()->back()->with('error', __('vote_has_been_submitted_unsuccessfully'));
	}
}
