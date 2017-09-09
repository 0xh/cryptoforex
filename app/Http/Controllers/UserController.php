<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\UserMeta;
use App\UserRights;
use App\Currency;
use App\Instrument;
use App\Deal;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq,$id=null){
        if(Auth::guest())return route('home');
        $user = $rq->user();
        if($user->rights_id<=1)return route('home');
        if(!is_null($id)) $users = [User::find($id)];
        else $users = User::all();
        $res = [];
        foreach($users as $user){
            $resor = $user->toArray();
            $country = UserMeta::user($user)->where('meta_name','country')->first();
            $ll = UserMeta::user($user)->where('meta_name','last_login')->first();
            $lip = UserMeta::user($user)->where('meta_name','last_login_ip')->first();
            $resor["country"] = is_null($country)?"-":$country->value;
            $resor["last_login"] = is_null($ll)?'':$ll->meta_value;
            $resor["last_ip"] = is_null($lip)?'':$lip->meta_value;
            $resor["account"] = [];
            // $resor["created_at"] =date("Y-m-d H:i:s",$user->created_at);
            $accounts = Account::user($user)->get();
            foreach ($accounts as $account) {
                $resor["account"][$account->type]=$account->toArray();
            }
            $res[]=$resor;
        }
        return response()->json($res);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $udata = $request->all();
        if(isset($udata["password"]))$udata["password"]=bcrypt($udata["password"]);
        $user->update($udata);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    /**
     * List of user rights
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function rights(){
        return response()->json(UserRights::all());
    }
    public function metaData(Request $rq){
        $user = User::find($rq->input("user_id"));
        $ud = [
            "meta_name" =>$rq->input("meta_name"),
            "meta_value" =>$rq->input("meta_value"),
            "user_id" => $user->id
        ];
        $um = UserMeta::user($user)->where('meta_name',$ud["meta_name"])->first();
        if(!is_null($ud["meta_value"]) && $ud["meta_value"]!="" ){
            if(is_null($um)||$um == false)$um=UserMeta::create($ud);
            else $um->update($ud);
        }
        return response()->json($um);
    }
}
