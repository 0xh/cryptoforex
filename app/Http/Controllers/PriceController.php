<?php

namespace App\Http\Controllers;

use DB;
use Log;
use App\Histo;
use App\Price;
use App\User;
use cryptofx\DataTune;
use Illuminate\Http\Request;

class PriceController extends Controller{
    protected $useRandom = 0; // 0 - if no data use random, 1-always, 2-mix data
    protected $_random = [
        "ticks"=>44
    ];
    public function __construct(){
        $this->useRandom = 0;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq,$format="json",$id="1"){
        $default = true;
        $random = [];
        $res = [];
        $precision = 100000;
        $histo = Histo::where("instrument_id",$id)->orderBy("id","desc")->first();
        //{ "date":"2017-10-29 09:19:00","open":12.44,"low":12.44,"high":12.44,"close":12.41,"value":12.41,"volumefrom":0,"volumeto":0,"volume":0 }
        //first
        $random[$histo->time]=[
            "id"=>"1132",
            "created_at"=>$histo->time,
            "updated_at"=>$histo->time,
            "price"=>$histo->open,
            "instrument_id"=>$histo->instrument_id,
            "source_id"=>$histo->source_id,
            "volation"=>$histo->volation
        ];
        $high = ($histo->high == $histo->low)?$histo->close:$histo->high;
        $low =  $histo->low;
        $old_price = floatval($histo->open);
        for($i=1;$i<58;++$i){
            $price = rand(intval($low*$precision),intval($high*$precision))/$precision;
            $volation = 0;
            if($price>$old_price)$volation = 1;
            else if($price<$old_price)$volation = -1;
            $old_price = $price;
            $random[$histo->time+$i]=[
                "id"=>"1132",
                "created_at"=>$histo->time+$i,
                "updated_at"=>$histo->time+$i,
                "price"=>$price,
                "instrument_id"=>$histo->instrument_id,
                "source_id"=>$histo->source_id,
                "volation"=>$volation
            ];
        }
        // last
        $random[$histo->time+60]=[
            "id"=>"1132",
            "created_at"=>$histo->time+60,
            "updated_at"=>$histo->time+60,
            "price"=>$histo->close,
            "instrument_id"=>$histo->instrument_id,
            "source_id"=>$histo->source_id,
            "volation"=>$histo->volation
        ];
        if($this->useRandom == 1) return response()->json($random)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        $res = Price::where('instrument_id',$id);
        if($rq->input("date_from","false")!="false") {$default=false;$res=$res->where("created_at",">=",intval($rq->input("date_from"))/1000);}
        if($rq->input("date_to","false")!="false") {$default=false;$res=$res->where("created_at","<=",intval($rq->input("date_to"))/1000);}
        if($default) $res=$res->whereRaw("created_at > unix_timestamp(DATE_SUB(NOW(),INTERVAL 1 MINUTE))");
        $res = $res->limit($rq->input("limit","60"))->orderBy('id','desc')->get();

        foreach($res as $row){
            $rr = $row->toArray();
            if(isset($random[$rr["created_at"]])) {
                $random[$rr["created_at"]] = $row->toArray();
            }
        }

        return response()->json(array_values($random))
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
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
     * @param  \App\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function show(Histo $histo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function edit(Histo $histo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Histo $histo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Histo  $histo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Histo $histo)
    {
        //
    }

    public function price(Request $rq,$format="json",$inst){
        $prices = Price::where('instrument_id','=',$inst)->orderBy('id','desc');
        return response()->json($prices->first(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
