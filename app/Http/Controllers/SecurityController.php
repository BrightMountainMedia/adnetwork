<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests;
use App\Http\Requests\SecurityUpdateRequest;

class SecurityController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('security');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SecurityUpdateRequest $request)
    {
        if ( ! Hash::check($request->current_password, $request->user()->password) ) {
            return redirect('/security')->with('error', 'The given password does not match our records.');
        }

        if ( $request->password === $request->password_confirmation ) {
            $user = $request->user();
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('/security')->with('success', 'Your Password has been Updated!');
        }

        return redirect('/security')->with('error', 'The given password and password confirmation do not match.');
    }
}
