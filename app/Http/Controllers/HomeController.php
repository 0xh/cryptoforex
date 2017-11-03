<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Account;

use App\User;
use App\Currency;
use App\Mail\SupportRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        if(Auth::guest()) return redirect('login');
        $user = $rq->user();
        $user_count = User::all()->count();
        $accounts = Account::where('user_id',$user->id)->get();
        return view('home',["user"=>$user,"accounts"=>$accounts,'currencies'=>Currency::all(),'online'=>rand($user_count,$user_count*3)]);
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
    public function support(Request $rq){
        $mail = [
            "from"=>$rq->input('from'),
            "email"=>$rq->input('email'),
            "phone"=>$rq->input('phone'),
            "text"=>$rq->input('text'),
        ];
        $sp = new SupportRequest(json_decode(json_encode($mail)));
        Mail::send($sp);
        return back();
    }
}
