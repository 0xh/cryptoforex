<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instruments';
    protected $appends = ['title'];
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
        'from_currency_id','to_currency_id','commission','enabled'
    ];
    public function from(){
        return $this->belongsTo('App\Currency','from_currency_id');
    }
    public function to(){
        return $this->belongsTo('App\Currency','to_currency_id');
    }
    public function history(){
        return $this->hasMany('App\InstrumentHistory');
    }
    public function histo(){
        return $this->hasOne('App\Histo')->orderBy('id','desc');
    }
    public function getTitleAttribute(){
        return $this->attributes['title']=$this->from->code.'/'.$this->to->code;
    }
}
