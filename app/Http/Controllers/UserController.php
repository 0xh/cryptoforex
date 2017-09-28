<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\UserMeta;
use App\UserRights;
use App\UserStatus;
use App\UserHierarchy;
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
    public function index(Request $rq,$format='json',$id=null){
        if(Auth::guest())return route('home');
        $user = $rq->user();
        if($user->rights_id<=1)return route('home');
        $users = User::where('id','>','0');
        if(!is_null($id)) $users = User::find($id);
        else if($rq->input("status_id",false)!==false && $rq->input("status_id")!= "false") $users = User::where('status_id','=',$rq->input("status_id"));
        else if($rq->input("rights_id",false)!==false && $rq->input("rights_id")!= "false") $users = User::where('rights_id','=',$rq->input("rights_id"));
        $users= $users->get();
        $res = [];
        foreach($users as $user){
            $resor = $user->toArray();
            $country = UserMeta::user($user)->meta('country')->first();
            $ll = UserMeta::user($user)->where('meta_name','last_login')->first();
            $lip = UserMeta::user($user)->where('meta_name','last_login_ip')->first();
            $resor["country"] = is_null($country)?"-":$country->meta_value;
            $resor["last_login"] = is_null($ll)?'':$ll->meta_value;
            $resor["last_ip"] = is_null($lip)?'':$lip->meta_value;
            $manager = UserHierarchy::where('user_id','=',$user->id)->first();
            $resor["manager"] = is_null($manager)?[]:User::find($manager->parent_user_id);
            $resor["status"] = UserStatus::find($user->status_id);
            $resor["rights"] = UserRights::find($user->rights_id);
            $resor["account"] = [];
            // $resor["created_at"] =date("Y-m-d H:i:s",$user->created_at);
            $accounts = Account::user($user)->get();
            foreach ($accounts as $account) {
                $resor["account"][$account->type]=$account->toArray();
            }
            $res[]=$resor;
        }
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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
    public function store(Request $rq){
        list($data,$res,$code)=[[],false,200];
        try{
            $data['name'] = $rq->input('name',false);
            $data['surname'] = $rq->input('surname',false);
            $data['rights_id'] = $rq->input('rights_id',false);
            $data['email'] = $rq->input('email',false);
            $data['phone'] = $rq->input('phone',false);
            $data['password'] = $rq->input('password',false);
            $data['status_id'] = $rq->input('status_id',false);
            if($data['rights_id']==false)$data['rights_id']=UserRights::where('name','=','client')->first()->id;
            if($data['status_id']==false)$data['status_id']=UserStatus::where('code','=','newclient')->first()->id;
            $user = User::create($data);
            $res = $user->toArray();
            $res['new_password'] = $password;
        }
        catch(Exception $e){
            $code = 500;
            $res = [
                "error"=>$e->getCode(),
                "message"=>$e->getMessage()
            ];
        }
        return response()->json($res,$code,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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
    public function update(Request $rq,$format='json',$id){
        list($res,$code)=[["error"=>"404","message"=>"User {$id} not found."],404];
        try{
            $user = User::findOrFail($id);
            $udata = $rq->all();
            if(isset($udata["password"]))$udata["password"]=bcrypt($udata["password"]);
            if(isset($udata["manager_id"])){
                $parent = User::findOrFail($udata["manager_id"]);
                $uh = UserHierarchy::user($user)->first();
                is_null($uh)?UserHierarchy::create(["user_id"=>$user->id,"parent_user_id"=>$parent->id]):$uh->update(["parent_user_id"=>$parent->id]);
            }
            if(isset($udata["country"])){
                $country = UserMeta::user($user)->meta('country')->first();
                $country = is_null($country)?UserMeta::create(['user_id'=>$user->id,"meta_name"=>"country","meta_value"=>$udata['country']]):$country->update(['meta_value'=>$udata['country']]);
            }
            $user->update($udata);
            return $this->index($rq,$format,$user->id);
        }
        catch(\Exception $e){
            $code = 500;
            $res = [
                "error"=>$e->getCode(),
                "message"=>$e->getMessage()
            ];
        }
        return response()->json($res,$code,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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
        return response()->json(UserRights::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function status(){
        return response()->json(UserStatus::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function useraccount(Request $rq){
        $user = User::find($rq->input("user_id"));
        $account = Account::where('user_id',$user->id)->get();
        return response()->json($account);
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
