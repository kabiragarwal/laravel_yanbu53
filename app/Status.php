<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status'];

    public function product(){
		return $this->hasMany('App\Product','status')->active();
	}
}
