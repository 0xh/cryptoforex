<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use App\User;
use App\UserRights;
use App\Account;

class UserDocument extends Model{
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_hierarchy';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','user_id','file','status'
    ];
    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUser($query,User $user)
    {
        return $query->where('user_id', '=', $user->id);
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
