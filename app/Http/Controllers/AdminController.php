<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Stats;
use App\Http\Requests;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\AddStatsRequest;
use App\Http\Requests\UpdateStatsRequest;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
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
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Get all publishers.
     *
     * @return Response
     */
    public function allPublishers()
    {
        $publishers = User::where('role', 'publisher')->orderBy('first_name')->get();

        return response()->json(['publishers' => $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStat(AddStatsRequest $request)
    {
        Stats::insert([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'site' => $request->site,
            'impressions' => $request->impressions,
            'served' => $request->served,
            'income' => $request->income,
            'tag' => $request->tag
        ]);

        $publisher = User::find($request->user_id);

        return response()->json(['publisher' => $publisher]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher = User::find($id);
        $stats = Stats::where('user_id', $id)->orderBy('date', 'DESC')->orderBy('id', 'DESC')->get();

        return response()->json(['publisher' => $publisher, 'stats' => $stats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\UpdateDepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStat(UpdateStatsRequest $request, $id)
    {
        Stats::where('id', $id)
            ->update([
                'user_id' => $request->user_id, 
                'date' => $request->date, 
                'site' => $request->site, 
                'impressions' => $request->impressions, 
                'served' => $request->served, 
                'income' => $request->income, 
                'tag' => $request->tag, 
            ]);

        $publisher = User::find($request->user_id);

        return response()->json(['publisher' => $publisher]);
    }

    /**
     * Store the user's profile photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadStats(Request $request, $id)
    {
        $path = Storage::putFile('public/stats', $request->file('stats'));
        $path = str_replace('public', 'storage', $path);
        echo "ID: ".$id."<br/>";
        Excel::load($path, function($reader) use ($id) {
            $reader->each(function($sheet) use ($id) {
                $date = explode('/', $sheet->date);
                $year = $date[2];
                $month = $date[0];
                $day = $date[1];
                $date = Carbon::createFromDate($year, $month, $day);
                $site = $sheet->site;
                $impressions = $sheet->impressions;
                $served = $sheet->served;
                $income = $sheet->income;
                $tag = $sheet->tag;

                Stats::insert([
                    'user_id' => $id,
                    'date' => $date,
                    'site' => $site,
                    'impressions' => $impressions,
                    'served' => $served,
                    'income' => $income,
                    'tag' => $tag
                ]);
            });
        });
    }
}
