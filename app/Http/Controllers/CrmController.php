<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Lead;
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
        $aggre = DB::table('users')->join('user_rights','user_rights.id','users.rights_id')
            ->selectRaw("sum(case when user_rights.name = 'admin' then 1 else 0 end) as admin")
            ->selectRaw("sum(case when user_rights.name = 'admin' and users.updated_at>=unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 DAY)) then 1 else 0 end) as admin_last")
            ->selectRaw("sum(case when user_rights.name = 'manager' then 1 else 0 end) as manager")
            ->selectRaw("sum(case when user_rights.name = 'manager' and users.updated_at>=unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 DAY)) then 1 else 0 end) as manager_last")
            ->selectRaw("sum(case when user_rights.name = 'affilate' then 1 else 0 end) as affilate")
            ->selectRaw("sum(case when user_rights.name = 'affilate' and users.updated_at>=unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 DAY)) then 1 else 0 end) as affilate_last")
            ->selectRaw("sum(case when user_rights.name = 'client' then 1 else 0 end) as client")
            ->selectRaw("sum(case when user_rights.name = 'client' and users.updated_at>=unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 DAY)) then 1 else 0 end) as client_last")
            ->selectRaw("sum(case when user_rights.name = 'fired' then 1 else 0 end) as fired")
            ->selectRaw("sum(case when user_rights.name = 'fired' and users.updated_at>=unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 DAY)) then 1 else 0 end) as fired_last")
            ;
        return view('crm.home',[
            "users"=>User::all(),
            "leads"=>Lead::all(),
            'currencies'=>Currency::all(),
            "instruments"=>Instrument::all(),
            "deals"=>Deal::all(),
            "counts"=>$aggre->first()
        ]);
    }
}
