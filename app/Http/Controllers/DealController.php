<?php

namespace App\Http\Controllers;

use Log;
use App\User;
use App\UserHierarchy;
use App\Deal;
use App\DealStatus;
use App\DealHistory;
use App\Currency;
use App\Price;
use App\Account;
use App\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;

class DealController extends Controller{
    protected  $trx;
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('online');
        $this->trx = new TransactionController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq,$format='json',$id=false){
        $user = $rq->user();
        $res = Deal::with(['user','manager','history','currency','instrument','open','close','status'])
            ->byStatus($rq->input("status","open"))
            ->byInstrument($rq->input("instrument_id",false))
            ->byUser(($user->rights_id<=1)?$user->id:$rq->input("user_id",false));
        if($id!==false) $res =$res->where('id','=',$id);
        if($rq->input("sort",false)!==false) {
            foreach ($rq->input("sort") as $key => $value) {
                $res =$res->orderBy($key,$value);
            }
        }
        Log::debug($res->toSql());
        return response()->json($res->paginate(2),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

        $res = [];
        $status = $rq->input("status","open");
        $selector = ($user->rights_id<=1)?Deal::where('user_id',$user->id):Deal::where('id','>','0');
        if($status!="all"){
            $status = DealStatus::where('code',$status)->first();
            if(!is_null($status))$selector = $selector->where("status_id",$status->id);
        }
        if($id!==false) $selector = Deal::where('id','=',$id);
        if($rq->input("user_id",false)!==false) $selector = $selector->where('user_id','=',$rq->input("user_id"));
        $deals = $selector->orderBy('id','desc')->get();
        Log::debug($selector->toSql());
        foreach($deals as $deal){
            $row = $deal->toArray();
            $row["instrument"] = Instrument::find($deal->instrument_id)->toArray();
            $row["instrument"]["from_currency"] = Currency::find($row["instrument"]["from_currency_id"]);
            $row["instrument"]["to_currency"] = Currency::find($row["instrument"]["to_currency_id"]);
            $row["open_price"] = Price::find($deal->open_price_id);
            $row["currency"] = Currency::find($deal->currency_id);
            $row["status"] = DealStatus::find($deal->status_id);
            $row["user"] = User::find($deal->user_id);
            $row["manager"] = UserHierarchy::user($row["user"])->first();
            if(!is_null($deal->close_price_id))$row["close_price"] = Price::find($deal->close_price_id);
            $res[]=$row;
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
        $amount = floatval ($rq->input("amount",0));
        $dealStatus = DealStatus::where('code',$rq->input('status','open'))->first();
        $user = $rq->user();

        $account = Account::where('user_id',$user->id)->where('type',$rq->input('account_type','demo'))->first();
        $this->trx->makeTransaction([
            'account'=>$account->id,
            'type'=>'credit',
            'user' => $rq->user(),
            'merchant'=>'1',
            'amount'=>(-$amount),
        ]);

        // $account->amount-=$amount;
        // $account->save();
        $currency = Currency::where('code',$rq->input('currency'))->first();
        $price = Price::where('instrument_id',$rq->input('instrument_id'))->orderBy('id','desc')->first();
        $dealData = [
            'status_id' => $dealStatus->id,
            'instrument_id'=>$rq->input('instrument_id'),
            'user_id'=>$user->id,
            'open_price_id'=>$price->id,
            'direction'=>$rq->input("direction"),
            'stop_high'=>$rq->input("stop_high"),
            'stop_low'=>$rq->input("stop_low"),
            'amount'=>$amount,
            'currency_id'=>$currency->id,
            'multiplier'=>$rq->input('multiplier',1)
        ];
        $deal = Deal::create($dealData);
        DealHistory::create([
            'deal_id'=>$deal->id,
            'old_status_id'=>$dealStatus->id,
            'new_status_id'=>$dealStatus->id,
            'changed_user_id'=>$user->id,
            'description'=>'Interface opened'
        ]);
        return response()->json($deal,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $rq, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $rq)
    {
        $dealStatus = DealStatus::where('code',$rq->input('status','close'))->first();
        $user = $rq->user();
        $account = Account::where('user_id',$user->id)->where('type',$rq->input('account_type','demo'))->first();
        $deal = Deal::find($rq->input("deal_id"));
        $account->amount+=$deal->profit;
        $account->save();
        $price = Price::where('instrument_id',$deal->instrument_id)->orderBy('id','desc')->first();
        $deal->update([
            "close_price_id"=>$price->id,
            "status_id" => $dealStatus->id
        ]);
        DealHistory::create([
            'deal_id'=>$deal->id,
            'old_status_id'=>$deal->status_id,
            'new_status_id'=>$dealStatus->id,
            'changed_user_id'=>$user->id,
            'description'=>'Interface opened'
        ]);

        return response()->json($deal,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

    }
}
