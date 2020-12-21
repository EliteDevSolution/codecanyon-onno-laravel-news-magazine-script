<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\Post\Entities\Poll;
use Modules\Post\Entities\PollOption;
use Modules\Post\Entities\Vote;
use Validator;
use DB;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function polls()
    {
        $polls      = Poll::orderBy('id', 'desc')->paginate(15);

        return view('post::polls', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('post::poll_create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'question'      => 'required|min:2',
            'option'        => 'required|min:2',
            'auth_required' => 'required',
            'status'        => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date'
        ])->validate();

        DB::beginTransaction();
        try {

            $poll                   = new Poll();

            $poll->question         = $request->question;
            $poll->auth_required    = $request->auth_required;
            $poll->status           = $request->status;
            $poll->start_date       = date('Y-m-d H:i:s', strtotime($request->start_date));
            $poll->end_date         = date('Y-m-d H:i:s', strtotime($request->end_date));

            $poll->save();

            $this->savePollOption($request, $poll);

            DB::commit();
            return redirect()->back()->with('success', __('successfully_added'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function savePollOption($request, $poll)
    {
        PollOption::where('poll_id', $poll->id)->delete();

        foreach ($request->option as $order => $option) {
            if (!empty($option)) {
                $data = [
                    'poll_id'   => $poll->id,
                    'option'    => $option,
                    'order'     => $order,
                ];

                PollOption::updateOrCreate(Arr::except($data, 'order'), $data);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $poll    = Poll::with('pollOptions')->find($id);
        return view('post::poll_edit', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'question'      => 'required|min:2',
            'auth_required' => 'required',
            'status'        => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date'
        ])->validate();

        DB::beginTransaction();
        try {

            $poll                   = Poll::find($id);

            $poll->question         = $request->question;
            $poll->auth_required    = $request->auth_required;
            $poll->status           = $request->status;
            $poll->start_date       = date('Y-m-d H:i:s', strtotime($request->start_date));
            $poll->end_date         = date('Y-m-d H:i:s', strtotime($request->end_date));

            $poll->save();

            $this->savePollOption($request, $poll);

            DB::commit();
            return redirect('post/polls')->with('success', __('successfully_updated'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
