<?php

namespace App\Http\Controllers\Auth;

use Log;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\UserMeta;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected function redirectTo(){
        $user = Auth::user();
        $ll = UserMeta::user($user)->where("meta_name","last_login")->first();
        Log::debug(json_encode($ll));
        if(is_null($ll) || $ll == false )UserMeta::create([
            "user_id"=>$user->id,
            "meta_name"=>"last_login",
            "meta_value"=> time()
        ]);else $ll->update(["meta_value"=>time()]);

        $lip = UserMeta::user($user)->where("meta_name","last_login_ip")->first();
        if(is_null($lip) || $lip == false ) UserMeta::create([
            "user_id"=>$user->id,
            "meta_name"=>"last_login_ip",
            "meta_value"=> Request::ip()
        ]);else $lip->update(["meta_value"=>Request::ip()]);
        if($user->rights_id>1) return '/crm';


        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
