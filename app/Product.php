<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcategory;
use App\Category;
//use File;

class Product extends Model {

    protected $fillable = ['title', 'slug','type', 'subcategory_id','price', 'price_negotiable', 'premiumadcategory_id', 'description','visitors','status'];

    public static function boot() {
        parent::boot();

        static::deleting(function($product) {
            $product->images->each(function($images) {
                \File::delete([
                    'upload/products/'.$images->image,   //full image
                    'upload/products/'.$images->thumbnail_image,  //thumbnail image
                ]);
                return true;
            });
        });
    }

    public function user(){
		return $this->belongsTo('App\User');
	}

    public function images(){
        return $this->hasMany('App\ProductImage');
    }

    public function FirstImage(){
        return $this->hasOne('App\ProductImage');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
        //return $this->belongsTo('App\Subcategory', 'subcategory_id')->with(`category`);
    }

    public function category(){
        return $this->subcategory->belongsTo('App\Category');
        //return $this->belongsTo('App\Subcategory', 'subcategory_id')->with(`category`);
    }

    public function subcategoryCat($category_id){
        return $this->belongsTo('App\Subcategory', 'subcategory_id')->with('category')
        ->where('category_id',$category_id);
    }

    public function premium_ad(){
        return $this->belongsToMany('App\PremiumAdCategory', 'premiumadcategory_product', 'product_id', 'premiumadcategory_id')
                        ->withTimestamps()
                        ->withPivot(['coupon_id', 'total_amount', 'discount_amount', 'net_amount','payment_method']);
    }

    public function premium_product(){
        return $this->belongsTo('App\PremiumAdCategory');
    }

    public function favourites(){
        return $this->hasMany('App\Favourite');
    }

    public function product_status(){
        return $this->belongsTo('App\Status','status');
    }

    public function abuses(){
        return $this->hasMany('App\ProductAbuse');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function setTitleAttribute($title){
        $this->attributes['slug'] = str_replace(' ', '-', strtolower(trim($title)));
        $this->attributes['title'] = $title;
        return $this;
    }

    public function scopeActive($query){
         return $query->where('status', 1);
    }

    public function scopeBuisness($query){
         return $query->where('type','Business')->count();
    }

    public function scopePrivate($query){
         return $query->where('type','Private')->count();
    }

    public function privateAds(){
         return $this->all()->where('type','Private')->count();
    }
}
