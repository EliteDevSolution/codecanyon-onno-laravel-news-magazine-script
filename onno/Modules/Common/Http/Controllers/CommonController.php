<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\VisitorTracker;
use Modules\User\Entities\Activation;
use Modules\Post\Entities\Post;
use Modules\Setting\Entities\Setting;
use Session;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['totalVisits']               = VisitorTracker::get();
        $data['totalUniqueVisitors']       = VisitorTracker::where('date', 'like', date('Y').'%')->get();
        $count = 0;
        foreach($data['totalUniqueVisitors']->groupBy('ip') as $key => $visitor){
           $count += $visitor->groupBy('url')->count();
        }

        $data['totalUniqueVisits']         = $count;
        $data['totalUniqueVisitors']       = $data['totalUniqueVisitors']->groupBy('ip')->count();

        $data['totalVisitors']             = $data['totalVisits']->groupBy('ip')->count();
        $data['usageBrowsers']             = $data['totalVisits']->groupBy('agent_browser');
        $data['registeredUsers']           = Activation::get();
        $data['publishedPost']             = Post::where('visibility', 1)->where('status', 1)->get();
        $data['submittedPost']             = Post::where('submitted', 1)->get();

        $month = date('Y-m');
        $visitors = VisitorTracker::where('date', 'like', '%' . $month . '%')->get();
        for($i = 1; $i <= date('t'); $i++){
            if ($i < 10) {
                $i = str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            // visits count
            $visits                    = $visitors->where('date', date('Y-m-'.$i));
            $data['dates'][] = $i;
            $data['visits'][]          = $visits->count();
            //visitor count
            $data['visitors'][]        = $visits->groupBy('ip')->count();
        } 

        $data['dates']                 = implode(',', $data['dates']);
        $data['visits']                = implode(',', $data['visits']);
        $data['visitors']              = implode(',', $data['visitors']);

        $data['posthits']              = Post::with('image')->orderBy('total_hit', 'DESC')->where('total_hit', '!=', 0)->paginate(10);

        return view('common::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('common::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('common::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('common::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
