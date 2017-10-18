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
        $ticks = 200;
        echo $this->signature." loaded as ".date("Y-m-d H:i:s")."\n";
        while($ticks!=0){
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


                if(is_null($oldprice) || $oldprice === false || floatval($oldprice->price) != floatval($rawpr->$tosymCode)){
                    echo "!!! CHANGED\t";
                    $price = Price::create([
                        'price'=>$rawpr->$tosymCode,
                        'instrument_id'=>$instrument->id,
                        'source_id'=>$source->id,
                        // 'volation' => ((floatval($oldprice->price) < floatval($rawpr->$tosymCode))?1:-1)
                    ]);
                    echo $fsym->code."/".$tsym->code.": was ".(is_null($oldprice)?"-":$oldprice->price)." - now ".$rawpr->$tosymCode."\n";
                }

            }
            echo "{$ticks}\n";
            --$ticks;
            usleep(400);
        }
    }
}
