<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//local classes
use DB;
use App\Price;
use App\PriceArc;

class CleanPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cryptofx:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean prices table by hour ago';

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
        $todel = Price::whereRaw('created_at < unix_timestamp(DATE_SUB(NOW(),INTERVAL 44 MINUTE))')->orderBy("id");
        $insert = $todel->get()->toArray();
        // print_r($insert);exit;
        foreach($insert as $row){
            // print_r($row);
            PriceArc::create($row);
        }
        $todel->delete();
    }

}
/*
insert into prices_arc
	select * from prices WHERE created_at < unix_timestamp(DATE_SUB(NOW(),INTERVAL 60 MINUTE));
delete from prices WHERE created_at < unix_timestamp(DATE_SUB(NOW(),INTERVAL 60 MINUTE));
*/
