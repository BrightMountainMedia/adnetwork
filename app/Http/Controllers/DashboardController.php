<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Stats;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $stats = Stats::where('user_id', $user->id)->get();
        $count = 10;
        if ( count($stats) > $count ) {
            $stats = Stats::where('user_id', $user->id)->paginate($count);
        }

        return view('dashboard', compact('stats'));
    }
}
