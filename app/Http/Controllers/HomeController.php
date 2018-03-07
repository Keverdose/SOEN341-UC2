<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\user;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the home page with a welcome message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $profile = DB::table('users')->join('profiles','users.id','=','profiles.user_id')
                                     ->select('users.*','profiles.*')
                                     ->where(['profiles.user_id'=>$user_id]) 
                                     ->first();
                                  
         return view('home',compact('user'),['profile'=>$profile]);
    }
}
