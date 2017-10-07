<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Currency;
use App\Instrument;
use App\Deal;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class CrmController extends Controller
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
    public function index(Request $rq){
        if(Auth::guest())return route('home');
        $user = $rq->user();
        if($user->rights_id<=1)return route('home');
        return view('crm.home',["users"=>User::all(),'currencies'=>Currency::all(),"instruments"=>Instrument::all(),"deals"=>Deal::all()]);
    }
}
