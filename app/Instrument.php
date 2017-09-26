<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instruments';
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_currency_id','to_currency_id','comission','enabled'
    ];
}
