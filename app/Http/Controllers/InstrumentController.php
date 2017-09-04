<?php

namespace App\Http\Controllers;

use App\Instrument;
use App\Currency;
use App\Price;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $res = [];
        $selector = Instrument::whereNotNull('id');
        // filters {
        // }
        foreach($selector->get() as $row){
            $tsym = Currency::find($row->to_currency_id);
            $fsym = Currency::find($row->from_currency_id);
            $title = $fsym->code."/".$tsym->code;
            $prices =Price::where('instrument_id',$row->id)->orderBy('id', 'desc')->limit(2)->get();
            $diff = 100*floatval($prices[0]->price)/floatval( $prices[1]->price) - 100;
            $direction = ($diff<0)?-1:1;
            $res[] = [
                "id" => $row->id,
                'title' => $title,
                "diff" => $diff,
                "direction" => $direction,
                "price" =>  $prices[0]->price,
                "from_currency" => $fsym,
                "to_currency" => $tsym
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
    public function update(Request $request, Instrument $instrument)
    {
        //
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
}
