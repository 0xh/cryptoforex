<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//local classes
use App\Deal;
use App\DealStatus;
use App\Price;
use App\Instrument;
use App\Currency;
use App\Source;
use cryptofx\CryptoCompareApi;
use cryptofx\DealMechanic;

class ProcessDeals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cryptofx:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process deals';

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
        echo "Proccess deals stated ....\n";
        $openDealStatus = DealStatus::where('code','close')->first();
        // $deals = Deal::orderBy('id')->get();

        $ticks = time();
        while(time()-$ticks<60){
            $deals = Deal::where('status_id','<>',$openDealStatus->id)->orderBy('id')->orderBy('updated_at')->get();
            foreach($deals as $deal){
                DealMechanic::fork($deal);
            }
            usleep(400);
        }
    }
}
