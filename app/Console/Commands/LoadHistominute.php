<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//local classes
use App\Histo;
use App\Instrument;
use App\Currency;
use App\Source;
use cryptofx\CryptoCompareApi;

class LoadHistominute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cryptofx:histo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Histrical data loading';

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
        foreach ($ins as $i=>$instrument) {
            $fsym = Currency::find($instrument->from_currency_id);
            $tsym = Currency::find($instrument->to_currency_id);
            $rq= [
                "fsym"=>$fsym->code,
                "tsym"=>$tsym->code,
                "limit"=>8
            ];
            $hists = $crapi->histominute($rq);
            foreach ($hists->Data as $i => $hist) {
                $repeat = Histo::where("time",$hist->time)->where('instrument_id',$instrument->id)->first();
                if(is_null($repeat))Histo::create([
                    'instrument_id'=>$instrument->id,
                    'source_id'=>$source->id,
                    'open'=>$hist->open,
                    'close'=>$hist->close,
                    'low'=>$hist->low,
                    'high'=>$hist->high,
                    'volumefrom'=>$hist->volumefrom,
                    'volumeto'=>$hist->volumeto,
                    'time'=>$hist->time
                ]);
            }
        }
    }
}
