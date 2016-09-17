<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $fillable = ['name', 'slug'];

    public function state() {
        return $this->hasMany('App\State');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function getAllCountry(){
        return $this->pluck('name','id');
    }
}
