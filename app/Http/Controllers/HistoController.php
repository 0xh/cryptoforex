<?php

namespace App\Http\Controllers;

use Log;
use App\Histo;
use App\Price;
use App\User;
use cryptofx\DataTune;
use Illuminate\Http\Request;

class HistoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq,$type="histoday"){
        $tq=[
            "fsym" => $rq->input("fsym","BTC"),
            "tsym" => $rq->input("tsym","BCH"),
            "limit" => $rq->input("limit","1440"),
        ];
        $dateFrom = $rq->input("date_from",false);
        $dateTo = $rq->input("date_to",false);
        $instid = $rq->input("instrument_id",1);
        $res = [];
        $histo = Histo::where('instrument_id',$instid);
        if($dateFrom!==false)$histo=$histo->where("time",">=",intval($dateFrom/1000));
        if($dateTo!==false)$histo=$histo->where("time","<=",intval($dateTo/1000));
        Log::debug($histo->toSql());
        $histo = $histo->limit($tq["limit"])->orderBy('id','desc')->get();

        $coef = 1;
        if($rq->input("user_id",false)!==false){
            $user = User::find($rq->input("user_id"));
            $coef = DataTune::fork($user);
        }
        foreach ($histo as $row) {
            $tores = [
                "date" => date("Y-m-d H:i:s",$row->time),
                "open"=>floatval($row->open)*$coef,
                "low"=>floatval($row->low)*$coef,
                "high"=>floatval($row->high)*$coef,
                "close"=>floatval($row->close)*$coef,
                "value"=>floatval($row->close)*$coef,
                "volumefrom"=> floatval($row->volumefrom),
                "volumeto"=> floatval($row->volumeto),
                "volume"=> floatval($row->volumeto)-floatval($row->volumefrom)
            ];
            $res[]=$tores;
        }
        // $res = $histo;
        // $type="histominute";
        // $url ="https://min-api.cryptocompare.com/data/".$type."?fsym=".$tq["fsym"]."&tsym=".$tq['tsym']."&limit=".$tq['limit']."&aggregate=1&e=CCCAGG";
        // $res = $this->_fetchJSON($url);
        // $res = $this->_amchartFormat($res);
        // return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_PRESERVE_ZERO_FRACTION)->header('Access-Control-Allow-Origin', '*')
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'])->header('Access-Control-Allow-Origin', '*')
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
