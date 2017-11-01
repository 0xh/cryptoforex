<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\UserMeta;
use App\UserRights;
use App\UserStatus;
use App\UserDocument;
use App\UserHierarchy;
use App\Currency;
use App\Instrument;
use App\Deal;
use Illuminate\Support\Facades\Auth;
use cryptofx\DataArray;
// use App\Http\Controllers\Auth\RegisterController;
use Log;
use DB;
class UserController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('online');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq,$format,$id){
        if(Auth::guest())return route('home');
        $user = $rq->user();
        if($user->rights_id<=1)return route('home');
        $user = User::with(['manager','accounts','rights','country','status','comment'
            // 'last_login'=>function($query){
            //     return $query;
            // },
            // 'last_ip'=>function($query){
            //     return $query;
            // }
        ])->withCount('users')->find($id);

        $ll = UserMeta::user($user)->where('meta_name','last_login')->first();
        $lip = UserMeta::user($user)->where('meta_name','last_login_ip')->first();
        $res = $user;
        return ($format=='json')
                ?response()->json($user,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
                :view('crm.user.dashboard',[
                    "user"=>$user,
                    "deals"=>Deal::byUser($id)->byStatus("open")->get(),
                    "documents"=>UserDocument::byUser($user)->get(),
                    "rights" => UserRights::byUser($rq->user())->get(),
                    "statuses" => UserStatus::all(),
                    "managers" => User::byRights($rq->user())->where('rights_id','>',$user->rights_id)->get()
                ]);
            ;
    }
    public function ulist(Request $rq,$format='json'){
        if(Auth::guest())return route('home');
        $user = $rq->user();
        if($user->rights_id<=1)return route('home');
        $res = User::with(['rights','status','accounts','manager','meta','last_login','last_ip','comment'])->withCount('users');
        if($rq->input('search',"false")!=="false")$res=$res->whereRaw("(users.name like '%".$rq->input('search',false)."%' or users.surname like '%".$rq->input('search',false)."%'  or users.email like '%".$rq->input('search',false)."%')");
        if($rq->input('status_id',"false")!=="false")$res=$res->where("status_id",$rq->input('status_id'));
        if($rq->input('rights_id',"false")!=="false")$res=$res->where("rights_id",$rq->input('rights_id'));
        if($rq->input('parent_id',"false")!=="false")$res=$res->where("parent_user_id",$rq->input('parent_id'));
        if($rq->input('country',"false")!=="false") $res=$res->whereIn("id",UserMeta::where('meta_name','country')->where('meta_value',$rq->input("country"))->select('user_id')->get());
        if($rq->input('online',"false")=="1")       $res=$res->whereIn("id",UserMeta::where('meta_name','last_login')->whereRaw('meta_value >= unix_timestamp(DATE_SUB(NOW(),INTERVAL 10 MINUTE))')->select('user_id')->get());
        if($rq->input('assigner',"false")=="1")       $res=$res->where('rights_id','>','2');
        $res=$res->byRights($user)->paginate();

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
        return ($format=='json')
                ?response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
                :view('crm.user.list',[
                    "rights"=>[
                        "list"=>UserRights::byUser($rq->user())->get(),
                        "admins"=>User::where("rights_id",7)->get(),
                        "managers"=>User::where("rights_id",5)->get(),
                        "selected"=>$rq->input('rights_id',false)
                    ],
                    "statuses"=>[
                        "list"=>UserStatus::all(),
                        "selected"=>$rq->input('status_id',false)
                    ],
                    "leads"=>[],
                    "counts"=>$aggre->get()
                ]);
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
    public function store(Request $rq,$format='json'){
        list($data,$res,$code)=[$rq->all(),false,200];
        try{
            $rg = app('App\Http\Controllers\Auth\RegisterController');
            $res = $rg->create($data);
            // if(!is_null($data['password']))$data['password'] = bcrypt($rq->input('password'));
            // if($data['rights_id']==false)$data['rights_id']=UserRights::where('name','=','client')->first()->id;
            // if(!isset($data['status_id']))$data['status_id']=UserStatus::where('code','=','registered')->first()->id;
            // $user = User::create($data);
            // $res = $user->toArray();
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
            $user = User::with(['manager','rights'])->find($id);
            $udata = $rq->all();
            // if(isset($udata["manager_id"])){
            //     $parent = User::find($udata["manager_id"]);
            //     $uh = UserHierarchy::where('user_id',$user->id)->first();
            //     if(is_null($uh))UserHierarchy::create(["user_id"=>$user->id,"parent_user_id"=>$parent->id]);
            //     else $uh->update(["parent_user_id"=>$parent->id]);
            // }
            if(isset($udata["country"])){
                $country = UserMeta::user($user)->meta('country')->first();
                $country = is_null($country)?UserMeta::create(['user_id'=>$user->id,"meta_name"=>"country","meta_value"=>$udata['country']]):$country->update(['meta_value'=>$udata['country']]);
            }
            if(isset($udata["password"])){
                if(is_null($udata["password"]))unset($udata["password"]);
                else {$udata["password"]=bcrypt($udata["password"]);}
            }

            $user->update($udata);
            $res=$user;
            $code=200;
            // return $this->index($rq,$format,$user->id);
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
    public function rights(Request $rq){
        return response()->json(UserRights::byUser($rq->user())->get(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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
    public function countries(Request $rq){
        $res=["data"=>[]];$sel = UserMeta::where('meta_name','=','country')->distinct()->get();
        foreach ($sel as $c) {
            $res["data"][]=[
                "id"=>$c->meta_value,
                "title"=>$c->meta_value
            ];
        }
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function documents(Request $rq,$format,$id){
        return response()->json(UserDocument::user(User::find($id))->get(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function hierarchy(Request $rq,$format,$id){
        return response()->json(UserHierarchy::with(['parent','user'])->byParent($id)->get(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function ban(Request $rq,$format,$id){
        $admin = $rq->user();
        $user = User::find($id);
        if(!is_null($user)){
            $firedRight = UserRight::where('name','fired');
            // UserHistory::create([]);
        }
        return response()->json($user,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function controll(Request $rq,$id){
        $admin = $rq->user();
        $user = User::where('parent_user_id',$id)->update(['parent_user_id'=>null]);
        return $this->index($rq,"html",$id);
    }
}
