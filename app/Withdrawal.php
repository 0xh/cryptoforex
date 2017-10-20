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
}
