<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $fillable = ['state_id', 'name', 'slug'];

    public function state() {
        return $this->belongsTo('App\State');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

}
