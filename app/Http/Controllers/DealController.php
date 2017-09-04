<?php

namespace App\Http\Controllers;

use App\Deal;
use App\DealStatus;
use App\DealHistory;
use App\Currency;
use App\Price;
use App\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq){
        $res = [];
        $user = $rq->user();
        $selector = Deal::where('user_id',$user->id);
        // filters {
        // }
        $deals = $selector->get();
        foreach($deals as $deal){
            $row = $deal->toArray();
            $row["instrument"] = Instrument::find($deal->instrument_id);
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
        $dealStatus = DealStatus::where('code',$rq->input('status','new'))->first();
        $user = $rq->user();
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
            'amount'=>floatval($rq->input("amount")),
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
    public function destroy(Deal $deal)
    {
        //
    }
}
