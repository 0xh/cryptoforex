<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DealStatus;
use App\Currency;
use App\Instrument;
use App\User;

class Deal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deals';
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id','instrument_id','user_id','open_price','close_price','direction',
        'stop_high','stop_low','amount','currency_id','multiplier',
        'profit','price_start','price_stop','account_id','volation'
    ];

    public function history(){
        return $this->hasMany('App\DealHistory');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function status(){
        return $this->belongsTo('App\DealStatus');
    }
    public function currency(){
        return $this->belongsTo('App\Currency');
    }
    public function instrument(){
        return $this->belongsTo('App\Instrument');
    }
    public function scopeByUser($query,$user){
        if(is_null($user) || $user==false) return $query;
        return $query->where('user_id', '=', $user);
    }
    public function scopeByInstrument($query,$str){
        if(false==$str || is_null($str) || "false"==$str) return $query;
        return $query->where('instrument_id', '=', $str);
    }
    public function scopeByStatus($query,$str){
        if($str==false || is_null($str) || $str == "all") return $query;
        $status = DealStatus::where('code','=',$str)->first();
        if($status===false || is_null($status)) return $query;
        return $query->where('status_id', '=', $status->id);
    }
}
