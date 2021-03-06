<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//local classes
use App\Price;
use App\Instrument;
use App\Currency;
use App\Source;
use cryptofx\CryptoCompareApi;

class LoadPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cryptofx:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get current prices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $crapi = new CryptoCompareApi;
        $source = Source::where('name','CryptoCompare')->first();
        $ins = Instrument::get();
        $time = time();
        $pairs = [];
        foreach ($ins as $i=>$instrument) {
            $fsym = Currency::find($instrument->from_currency_id);
            $tsym = Currency::find($instrument->to_currency_id);
            $pairs[$instrument->id] = [
                "fsym"=>$fsym->code,
                "tsyms"=>$tsym->code,
            ];
        }
        while((time()-$time)<59){
            $crapi->prices($pairs,function($callback)use($source){
                // print_r($callback);exit;
                $rawpr = json_decode($callback["response"]);
                $tosymCode = $callback["request"]["tsyms"];
                $volation = 0;
                $oldprice = Price::where('instrument_id',$callback["id"])->orderBy('id','desc')->first();
                if(!isset($rawpr->$tosymCode)){
                    // print_r($rawpr);
                    return;
                }
                if(is_null($oldprice) || $oldprice === false ||  floatval($oldprice->price) != floatval($rawpr->$tosymCode) ){
                    if(!is_null($oldprice)){
                        if(floatval($oldprice->price) < floatval($rawpr->$tosymCode)) $volation =1;
                        else if(floatval($oldprice->price) > floatval($rawpr->$tosymCode))  $volation=-1;
                    }
                    echo "!!! CHANGED\t";
                    echo "Instrument#".$callback["id"]." ".$callback["request"]["fsym"]."/".$callback["request"]["tsyms"]." : was ".(is_null($oldprice)?'-':floatval($oldprice->price))." - now ".floatval($rawpr->$tosymCode)."\n";
                    $price = Price::create([
                        'price'=>floatval($rawpr->$tosymCode),
                        'instrument_id'=>$callback["id"],
                        'source_id'=>$source->id,
                        'volation' => $volation
                    ]);
                }
            });
            echo "in ".(time()-$time)." {$time}:".time()."\n";
            usleep(400);
        }
    }
    public function handle_old(){
        $crapi = new CryptoCompareApi;
        $source = Source::where('name','CryptoCompare')->first();
        $ins = Instrument::get();
        $time = time();
        while((time()-$time)<59){
            foreach ($ins as $i=>$instrument) {
                $fsym = Currency::find($instrument->from_currency_id);
                $tsym = Currency::find($instrument->to_currency_id);
                $rq= [
                    "fsym"=>$fsym->code,
                    "tsyms"=>$tsym->code,
                ];
                $oldprice = Price::where('instrument_id',$instrument->id)->orderBy('id','desc')->first();
                $rawpr = $crapi->price($rq);
                $tosymCode = $tsym->code;
                $volation = 0;

                if(is_null($oldprice) || $oldprice === false ||  floatval($oldprice->price) != floatval($rawpr->$tosymCode) ){
                    if(floatval($oldprice->price) < floatval($rawpr->$tosymCode)) $volation =1;
                    else if(floatval($oldprice->price) > floatval($rawpr->$tosymCode))  $volation=-1;
                    echo "!!! CHANGED\t";
                    echo $fsym->code."/".$tsym->code.": was ".floatval($oldprice->price)." - now ".floatval($rawpr->$tosymCode)."\n";
                    $price = Price::create([
                        'price'=>floatval($rawpr->$tosymCode),
                        'instrument_id'=>$instrument->id,
                        'source_id'=>$source->id,
                        'volation' => $volation
                    ]);
                }

            }
            echo "in ".(time()-$time)." {$time}:".time()."\n";
            usleep(300);
        }
    }
}
/*
insert into prices_arc
	select * from prices WHERE created_at < unix_timestamp(DATE_SUB(NOW(),INTERVAL 60 MINUTE));
delete from prices WHERE created_at < unix_timestamp(DATE_SUB(NOW(),INTERVAL 60 MINUTE));
*/
