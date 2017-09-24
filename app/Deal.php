<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'status_id','instrument_id','user_id','open_price_id','close_price_id','direction',
        'stop_high','stop_low','amount','currency_id','multiplier',
        'profit','price_start','price_stop'
    ];
}
