<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
    protected $fillable = ['user_id','product_id','name','email','phone','message','message_status'];

    // public function setEmailAttribute($email){
    //     $this->attributes['email'] = $email;
    //     $this->attributes['user_id'] = (Auth::check())?(Auth::id()):0;
    //     return $this;
    // }

    public function product(){
        return $this->belongsTo('App\Product')->active();
    }
}
