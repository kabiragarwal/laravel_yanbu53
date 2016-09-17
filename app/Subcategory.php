<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name','slug','category_id'];

    public function product(){
        return $this->hasMany('App\Product', 'subcategory_id')->active();
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
