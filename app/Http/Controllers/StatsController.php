<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Stats;
use App\Http\Requests;
use App\Http\Requests\AddStatsRequest;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get the publisher profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function profile($publisherId)
    {
        $publisher = User::where('id', $publisherId)->first();
        $stats = Stats::where('user_id', $publisherId)->orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        return response()->json(['publisher' => $publisher, 'stats' => $stats]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = User::where('role', 'publisher')->get();
        if ( count($publishers) > 10 ) {
            $publishers = User::where('role', 'publisher')->paginate(10);
        }

        return view('admin.stats', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStatsRequest $request)
    {
        Stats::insert([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'site' => $request->site,
            'impressions' => $request->impressions,
            'served' => $request->served,
            'fill' => $request->fill,
            'income' => $request->income,
            'ecpm' => $request->ecpm,
            'tag' => $request->tag
        ]);

        $user = User::where('id', $request->user_id)->first();
        $publisher = $user['first_name']. ' ' .$user['last_name'];

        return response('/admin/add-stats');
        // return redirect('/admin/add-stats')->with('success', 'Stats Added for ' . $publisher . '!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
