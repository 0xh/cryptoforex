<?php
namespace cryptofx;
use App\Deal;
use App\DealHistory;
use App\DealStatus;
use App\User;
use App\UserMeta;
use App\Option;
use App\Price;
class DataTune{
    public static function fork(User $user){
        $usertune = UserMeta::user($user)->byName("user_chart_tune")->first();
        if(is_null($usertune) || $usertune == false) return 1;
        $utdata = UserMeta::user($user)->byName("user_chart_tune_data")->first();
        $data = [
            "last"=>time(),
            "from"=>1,
            "to"=>1+(intval($usertune->meta_value)/100),
            "current"=>1,
            "step"=>0.05,
            "done"=>0
        ];
        if(!is_null($utdata) && $utdata !== false){
            $data = json_decode($utdata->meta_value,true);
            if($data["current"]==$data["to"]){
                $data["done"] = 1;
            }
            else if(time()-$data["last"]>1){
                $data["current"]= $data["current"]+((($data["to"]-$data["from"])<0)?-1:1)*$data["step"];
                $data["last"] = time();
            }
        }else{
            $utdata = UserMeta::create([
                "meta_name"=>"user_chart_tune_data",
                "meta_value"=>json_encode($data),
                "user_id"=>$user->id
            ]);
        }
        $utdata->update(["meta_value"=>json_encode($data)]);
        return $data["current"];
    }
};
?>
