<?php
namespace cryptofx;
use App\Deal;
use App\DealHistory;
use App\DealStatus;
use App\User;
use App\Option;
use App\Price;
class DealMechanic{
    public static function fork(Deal $deal){
        $user = User::find($deal->user_id);
        $option = Option::where("user_id",$user->id)->where('name','fork')->first();
        $fork = (is_null($option)?1:floatval($option->value));
        $price_start = Price::find($deal->open_price_id);
        $price = Price::where('instrument_id',$deal->instrument_id)->orderBy('id','desc')->first();
        $dealUpdate = [];
        $profit = $deal->amount*$deal->multiplier*(($deal->direction*(floatval($price_start->price)-floatval($price->price))/floatval($price_start->price)));

        $dealUpdate["profit"] = $profit;
        $dealCloseStatus = DealStatus::where('code','close')->first();
        if($deal->stop_low>0 && ($deal->amount+$profit)<=$deal->stop_low){
            $dealUpdate["profit"] = $deal->stop_low - $deal->amount;
            $dealUpdate["close_price_id"] = $price->id;
            $dealUpdate["status_id"] = $dealCloseStatus->id;
            DealHistory::create([
                'deal_id'=>$deal->id,
                'old_status_id'=>$deal->status_id,
                'new_status_id'=>$dealCloseStatus->id,
                'changed_user_id'=>$user->id,
                'description'=>'Stop profit signal'
            ]);
        }
        else if($deal->stop_high>0 && ($deal->amount+$profit)>=$deal->stop_high){
            $dealUpdate["profit"] = $deal->amount- $deal->stop_high;
            $dealUpdate["close_price_id"] = $price->id;
            $dealUpdate["status_id"] = $dealCloseStatus->id;
            DealHistory::create([
                'deal_id'=>$deal->id,
                'old_status_id'=>$deal->status_id,
                'new_status_id'=>$dealCloseStatus->id,
                'changed_user_id'=>$user->id,
                'description'=>'Stop profit signal'
            ]);
        }
        else if(($deal->amount+$profit)<=0){
            $dealUpdate["profit"]=-$deal->amount;
            $dealUpdate["close_price_id"] = $price->id;
            $dealUpdate["status_id"] = $dealCloseStatus->id;
            DealHistory::create([
                'deal_id'=>$deal->id,
                'old_status_id'=>$deal->status_id,
                'new_status_id'=>$dealCloseStatus->id,
                'changed_user_id'=>$user->id,
                'description'=>'No more amount'
            ]);
        }
        $deal->update($dealUpdate);
        // print_r(array_merge($dealUpdate,[
        //     "deal_id"=>$deal->id,
        //     "profit"=>$profit,
        //     "amount"=>$deal->amount,
        //     "multiplier"=>$deal->multiplier,
        //     "direction"=>$deal->direction,
        //     "start_price"=>$price_start->price,
        //     "price"=>$price->price
        // ]));
    }
};
?>
