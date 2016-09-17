<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumAdCategory extends Model
{
    protected $fillable = ['name', 'amount'];

    public function product(){
        return $this->belongsToMany('App\Product', 'premiumadcategory_product', 'premiumadcategory_id', 'product_id')
                        ->withTimestamps()
                        ->withPivot(['coupon_id', 'total_amount', 'discount_amount', 'net_amount','payment_method']);
    }

    public function premium_records(){
        return $this->hasMany('App\Product');
    }
}
