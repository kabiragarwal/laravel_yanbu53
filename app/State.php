<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $fillable = ['country_id', 'name', 'slug'];

    public function city() {
        return $this->hasMany('App\City');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function getAllState(){
        return $this->pluck('name','id');
    }
}
