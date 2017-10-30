<?php

namespace App\Http\Controllers;

use Log;
use App\Instrument;
use App\InstrumentHistory;
use App\Currency;
use App\Price;
use App\Histo;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq, $format='json',$id=false){
        $res = Instrument::with([
            'from',
            'to',
            'history',
            // 'histo'
        ])->find($id);
        // $ret = $res->toArray();
        // $ret["histo"] = Histo::where('instrument_id',$res->id)->orderBy('id','desc')->first();
        return ($format=='json')
                ?response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
                :view('crm.instrument.dashboard',["row"=>$res]);
    }
    public function indexes(Request $rq, $format='json'){
        $res = Instrument::with([
            'from',
            'to',
            // 'history',
            // 'histo'
        ]);
        // Log::debug('Instrument list: '.$res->toSql());
        $ret = $res->paginate($rq->input("limit",100))->toArray();
        foreach($ret["data"] as &$row){
            $row["histo"] = Histo::where('instrument_id',$row["id"])->orderBy('id','desc')->first();
        }
        return ($format=='json')
                ?response()->json($ret,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)
                :view('crm.instrument.list',["rows"=>$ret]);
    }
    public function indexes2(Request $rq, $format='json',$id=false){
        $res = [];
        $selector = ($id===false)?Instrument::whereNotNull('id'):Instrument::where('id','=',$id);
        // filters {
        // }
        foreach($selector->get() as $row){
            $tsym = Currency::find($row->to_currency_id);
            $fsym = Currency::find($row->from_currency_id);
            $title = $fsym->code."/".$tsym->code;
            $prices =Price::where('instrument_id',$row->id)->orderBy('id', 'desc')->limit(2)->get();
            $histo = Histo::where('instrument_id',$row->id)->orderBy('id', 'desc')->first();
            // $diff =(!is_null($prices) && !empty($price))?(100*floatval($prices[0]->price)/floatval( $prices[1]->price) - 100):0;
            $diff =(!is_null($histo) && !empty($histo))?(100*floatval($histo->close)/floatval( $histo->open) - 100):0;
            $direction = ($diff<0)?-1:1;
            $res[] = [
                "id" => $row->id,
                'title' => $title,
                "diff" => $diff,
                "direction" => $direction,
                "price" =>  $prices[0]->price,
                "histo" =>  $histo,
                "from_currency" => $fsym,
                "to_currency" => $tsym,
                "commission" => $row->commission,
                "enabled" => $row->enabled
            ];
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function show(Instrument $instrument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrument $instrument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $rq,$forma='json',$id){
        list($res,$code)=[["error"=>"404","message"=>"User {$id} not found."],404];
        try{
            $code = 200;
            $instrument = Instrument::findOrFail($id);
            $ud = $rq->all();
            InstrumentHistory::create([
                'instrument_id'=>$instrument->id,
                'old_enabled'=>$instrument->enabled,
                'new_enabled'=>isset($ud['enabled'])?$ud['enabled']:$instrument->enabled,
                'old_commission'=>$instrument->commission,
                'new_commission'=>isset($ud['commission'])?$ud['commission']:$instrument->commission,
            ]);
            $instrument->update($ud);
            $res = $instrument;

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
     * @param  \App\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument)
    {
        //
    }
    public function history(Request $rq,$format='json',$id){
        return response()->json(InstrumentHistory::where('instrument_id','=',$id)->orderBy('id','desc')->get(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
