<?php

namespace App\Http\Controllers;

use Log;
use App\User;

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
        // $res = Deal::where('id','>','9')
        $res = Deal::with(['user'=>function($query){
                $query->with(['manager']);
            },'currency','instrument'=>function($query){
            $query->with(['from','to']);
        },'status']);

        if($id!==false) {
            $res =$res->where('id','=',$id);
        }
        else {
            $res = $res->byStatus($rq->input("status","open"))
                ->byInstrument($rq->input("instrument_id",false))
                ->byUser(($user->rights_id<=1)?$user->id:$rq->input("user_id",false));
            if($rq->input("status_id","false") !== "false") $res =$res->where('status_id','=',$rq->input("status_id"));
            if($rq->input("sort",false)!==false) {
                foreach ($rq->input("sort") as $key => $value) {
                    $res =$res->orderBy($key,$value);
                }
            }
        }
        // Log::debug($res->toSql());
        return ($format=='json')
                ?response()->json($res->orderBy('id','desc')->paginate(12),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
                :(($id==false)
                    ?view('crm.deal.list',["deals"=>$res->paginate(12)])
                    :view('crm.deal.dashboard',[
                        "deal"=>$res->first(),
                        'price'=>Price::where('instrument_id','=',$res->first()->instrument->id)->orderBy('id','desc')->first()
                    ])
                );


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

        $user = $rq->user();

        $account = Account::where('user_id',$user->id)->where('type',$rq->input('account_type','demo'))->first();
        $trx = $this->trx->makeTransaction([
            'account'=>$account->id,
            'type'=>'credit',
            'user' => $rq->user(),
            'merchant'=>'1',
            'amount'=>-$amount,
        ]);
        if($trx->code!="200")return response()->json($trx,$trx->code,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $currency = Currency::where('code',$rq->input('currency'))->first();
        $price = Price::where('instrument_id',$rq->input('instrument_id'))->orderBy('id','desc')->first();
        $dealStatus = DealStatus::where('code',$rq->input('status','open'))->first();
        $instrument = Instrument::find($rq->input('instrument_id'));
        $fee = floatval($amount)*floatval($instrument->commission);
        $trx = $this->trx->makeTransaction([
            'account'=>$account->id,
            'type'=>'fee',
            'user' => $rq->user(),
            'merchant'=>'1',
            'amount'=>$fee,
        ]);
        if($trx->code!="200")return response()->json($trx,$trx->code,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $dealData = [
            'status_id' => $dealStatus->id,
            'instrument_id'=>$instrument->id,
            'user_id'=>$user->id,
            'open_price'=>$price->price,
            'direction'=>$rq->input("direction"),
            'stop_high'=>$rq->input("stop_high"),
            'stop_low'=>$rq->input("stop_low"),
            'amount'=>$amount,
            'currency_id'=>$currency->id,
            'multiplier'=>$rq->input('multiplier',1),
            'account_id'=>$account->id,
            'fee'=>$fee
        ];
        if($rq->input("delayed","false") == "true"){
            $dealStatus = DealStatus::where('code',$rq->input('status','delayed'))->first();
            $dealData['open_price']=$rq->input("atprice");
            $dealData['status_id'] = $dealStatus->id;
        }
        $deal = Deal::create($dealData);
        DealHistory::create([
            'deal_id'=>$deal->id,
            'old_status_id'=>$dealStatus->id,
            'new_status_id'=>$dealStatus->id,
            'changed_user_id'=>$user->id,
            'description'=>'Interface opened'
        ]);
        $res = $deal->toArray();
        $res['instrument'] = $instrument->toArray();
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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

        $deal = Deal::find($rq->input("deal_id"));
        $account = Account::find($deal->account_id);
        $price = Price::where('instrument_id',$deal->instrument_id)->orderBy('id','desc')->first();
        $deal->update([
            "close_price"=>$price->price,
            "status_id" => $dealStatus->id
        ]);
        DealHistory::create([
            'deal_id'=>$deal->id,
            'old_status_id'=>$deal->status_id,
            'new_status_id'=>$dealStatus->id,
            'changed_user_id'=>$user->id,
            'description'=>'Interface opened'
        ]);
        $this->trx->makeTransaction([
            'account'=>$account->id,
            'type'=>'debit',
            'user' => $user,
            'merchant'=>'1',
            'amount'=>($deal->amount + $deal->profit)
        ]);
        return response()->json($deal,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

    }
    public function statuses(Request $rq){
        return response()->json(DealStatus::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

    }
}
