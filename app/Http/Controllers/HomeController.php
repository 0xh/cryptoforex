<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Currency;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq){
        if(Auth::guest()) return view('welcome');
        $user = $rq->user();
        $accounts = Account::where('user_id',$user->id)->get();
        return view('home',["user"=>$user,"accounts"=>$accounts,'currencies'=>Currency::all()]);
    }
    /**
     * Show the application page.
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Request $rq,$page){
        return view('page.'.$page);
    }
    public function page2(Request $rq,$page){
        return view('page_home.'.$page);
    }
}
