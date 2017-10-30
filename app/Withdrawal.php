<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'withdrawals';
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
        'status','account_id','amount','merchant_id','user_id'
    ];
    /*
    $r['merchant'] = Merchant::find($row->merchant_id);unset($r['merchant_id']);
    $r['manager'] = User::find($row->user_id);unset($r['user_id']);
    $acc = Account::find($row->account_id);
    $r["user"] = User::find($acc->user_id);
    $r["currency"] = Currency::find($acc->currency_id);unset($r['account_id']);
    */
    public function merchant(){
        return $this->belongsTo('App\Merchant');
    }
    public function manager(){
        return $this->belongsTo('App\User');
    }
    public function account(){
        return $this->belongsTo('App\Account');
    }
    public function scopeById($query,$id){
        return ($id == false )?$query:$query->where('id',$id);
    }
    public function scopeByStatus($query,$f){
        return ($f == false )?$query:$query->where('status',$f);
    }
}
