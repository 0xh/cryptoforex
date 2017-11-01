<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use App\UserMeta;
use App\UserRights;
use App\Account;

class User extends Authenticatable
{
    use Notifiable;
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
        'name','surname','rights_id', 'email', 'phone','password','status_id','parent_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function rights(){
        return $this->belongsTo('App\UserRights');
    }
    public function status(){
        return $this->belongsTo('App\UserStatus');
    }
    public function accounts(){
        return $this->hasMany('App\Account');
    }
    public function country(){
        return $this->belongsTo('App\UserRights');
    }
    public function manager(){
        //'parent_user_id','user_id'
        return $this->belongsTo('App\User','parent_user_id');
    }
    public function users(){
        //'parent_user_id','user_id'
        return $this->hasMany('App\User','parent_user_id','id');
    }
    public function meta(){
        //'parent_user_id','user_id'
        return $this->hasMany('App\UserMeta');
    }
    public function last_login(){
        return $this->belongsTo('App\UserMeta')->where('meta_name','last_login');
    }
    public function last_ip(){
        return $this->belongsTo('App\UserMeta')->where('meta_name','last_ip');
    }
    public function comment(){
        return $this->hasMany('App\UserMeta','user_id')->where('meta_name','comment');
    }
    public function deal(){
        return $this->hasMany('App\Deal');
    }
    public function onDeals(){
        return $this->deal->sum('amount');
    }
    public function scopeByRights($query,User $user){
        return $query->where('rights_id','<',$user->rights_id);
    }
    public function getTitleAttribute(){
        return $this->name." ".$this->surname;
    }
}
