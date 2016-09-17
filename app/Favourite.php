<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['product_id','user_id'];

    public function product(){
		return $this->belongsTo('App\Product')->active();
	}
}
