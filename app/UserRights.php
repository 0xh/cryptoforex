<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRights extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_rights';
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','title'
    ];
    public $incrementing = false;
}
