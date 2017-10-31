<?php
namespace cryptofx;
use App\Deal;
use App\DealHistory;
use App\DealStatus;
use App\User;
use App\Account;
use App\Option;
use App\Price;
use App\Http\Controllers\TransactionController;
class DealMechanic{
    public static function fork(Deal $deal){
        $user = User::find($deal->user_id);
        $account = Account::find($deal->account_id);

        $dealCloseStatus = DealStatus::where('code','close')->first();
        $dealOpenStatus = DealStatus::where('code','open')->first();
        $dealDelayedStatus = DealStatus::where('code','delayed')->first();
        $option = Option::where("user_id",$user->id)->where('name','fork')->first();
        $fork = (is_null($option)?1:floatval($option->value));
        $price = Price::where('instrument_id',$deal->instrument_id)->orderBy('id','desc')->first();

        if($deal->status_id==$dealDelayedStatus->id){//delayed
            $prices = Price::where('instrument_id',$deal->instrument_id)->orderBy('id','desc')->limit(2)->get();
            $atprice = floatval($deal->open_price);
            $before = floatval($prices[0]->price);
            $after = floatval($prices[1]->price);
            if( ($before<=$atprice && $atprice<=$after) || ($before>=$atprice && $atprice>=$after) ){
                $deal->update(["status_id"=>$dealOpenStatus->id]);
                DealHistory::create([
                    'deal_id'=>$deal->id,
                    'old_status_id'=>$deal->status_id,
                    'new_status_id'=>$dealOpenStatus->id,
                    'changed_user_id'=>$user->id,
                    'description'=>'Delayed deal is opened now'
                ]);
            }
        }
        if($deal->status_id==$dealOpenStatus->id){//delayed
            $dealUpdate = ["close_price" => $price->price];
            $profit = $deal->amount
                        *$deal->multiplier
                        *(
                            $deal->direction
                                *(floatval($price->price)-floatval($deal->open_price))/floatval($deal->open_price)
                        );
            echo json_encode([
                "id"=>$deal->id,
                "instrument"=>$deal->instrument_id,
                "open"=>$deal->open_price,
                "current"=>$price->price,
                "multiplier"=>$deal->multiplier,
                "profit"=>$profit,
                "stops"=>$deal->stop_low."-".$deal->stop_high
            ])."\n";
            $dealUpdate["profit"] =$profit;

            if($deal->stop_low>0 && ($deal->amount+$profit)<=$deal->stop_low){
                $dealUpdate["profit"] = $deal->stop_low - $deal->amount;

                $dealUpdate["status_id"] = $dealCloseStatus->id;
                DealHistory::create([
                    'deal_id'=>$deal->id,
                    'old_status_id'=>$deal->status_id,
                    'new_status_id'=>$dealCloseStatus->id,
                    'changed_user_id'=>$user->id,
                    'description'=>'Stop lost signal'
                ]);
            }
            if($deal->stop_high>0 && $profit>=$deal->stop_high){
                $dealUpdate["profit"] = $deal->amount- $deal->stop_high;
                $dealUpdate["status_id"] = $dealCloseStatus->id;
                DealHistory::create([
                    'deal_id'=>$deal->id,
                    'old_status_id'=>$deal->status_id,
                    'new_status_id'=>$dealCloseStatus->id,
                    'changed_user_id'=>$user->id,
                    'description'=>'Stop profit signal'
                ]);
                $trx = new TransactionController();
                $trx->makeTransaction([
                    'account'=>$account->id,
                    'type'=>'deposit',
                    'user' => $user,
                    'merchant'=>'1',
                    'amount'=>$deal->amount + $deal->stop_high,
                ]);
            }
            if(($deal->amount+$profit)<=0){
                $dealUpdate["profit"]=0;
                $dealUpdate["status_id"] = $dealCloseStatus->id;
                DealHistory::create([
                    'deal_id'=>$deal->id,
                    'old_status_id'=>$deal->status_id,
                    'new_status_id'=>$dealCloseStatus->id,
                    'changed_user_id'=>$user->id,
                    'description'=>'No more amount'
                ]);
            }
            $dealUpdate['volation'] = 0;
            if(floatval($deal->profit)<floatval($dealUpdate['profit']))$dealUpdate['volation']=1;
            else if(floatval($deal->profit)>floatval($dealUpdate['profit']))$dealUpdate['volation']=-1;
            $deal->update($dealUpdate);
        }
    }
};
?>
