<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_type', 'first_name', 'last_name', 'email', 'password', 'phone', 'hide_phone', 'gender', 'token',
        'address', 'city_id', 'state_id', 'country_id', 'zip_code', 'image', 'profile_visit', 'verified', 'newsletter',
        'suggestions','premiumadcategory_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $baseDir = 'upload/users';

    public static function boot(){
        parent::boot();

        static::creating(function($user){
            $user->token = str_random(30);
        });

        static::deleting(function($user) {
            \File::delete([
                'upload/users/'.$user->image,   //full image
            ]);

            $user->productImages->each(function($productImages) {
                \File::delete([
                    'upload/products/'.$productImages->image,   //full image
                    'upload/products/'.$productImages->thumbnail_image,  //thumbnail image
                ]);
            });
        });
    }

    public function product(){
        return $this->hasMany('App\Product')->active();
    }

    public function activeProduct(){
        return $this->hasMany('App\Product')->where('status',1);
    }

    public function pendingProduct(){
        return $this->hasMany('App\Product')->where('status',3);
    }

    public function ArchivedProduct(){
        return $this->hasMany('App\Product')->where('status',4);
    }

    public function roles(){
        return $this->belongsToMany('App\Role')
                ->withTimestamps();
    }

	public function city(){
		return $this->belongsTo('App\City');
	}

	public function state(){
		return $this->belongsTo('App\State');
	}

	public function country(){
		return $this->belongsTo('App\Country');
	}

    public function premium_ad_category(){
        return $this->belongsToMany('App\PremiumAdCategory');
    }

    public function saveAllSearches(){
        return $this->hasMany('App\SaveAllSearche');
    }

    public function saveProduct($product){
       return $this->product()->save($product);
    }

    public function favourites(){
        return $this->hasMany('App\Favourite');
    }

    public function setPasswordAttribute($password){
        return $this->attributes['password'] = bcrypt($password);
    }

    public function productImages(){
       return $this->hasManyThrough('App\ProductImage', 'App\Product');
    }

    public function messages(){
        return $this->hasManyThrough('App\Message', 'App\Product');
        //product_id
        //->with('product', 'product.FirstImage')->latest()
    }

    public function new_messages(){
        return $this->hasManyThrough('App\Message', 'App\Product')->where('message_status',0);
        //product_id
    }

    public function productAbuse(){
       return $this->hasManyThrough('App\ProductAbuse', 'App\Product');
    }

    public function owns($relation){
        return $this->id == $relation->user_id;
    }

    public function notHavingImageInDb(){
        return (empty($this->image))?true:false;
        //return true;
    }

    public function confirmEmail(){
        $this->token = null;
        $this->verified= true;
        $this->save();
    }

    public function updateToken(User $user){
        $this->token = str_random(30);
        $this->save();
    }

    public function updateToken1(){
        return 'test';
    }

    public function updatePassword($password){
        $this->password = $password;
        //$this->token= null;  //change fro password reset
        $this->save();
    }

   public function profilePhotoUpload(UploadedFile $file){
       $imageName = sprintf("%s-%s", time(), $file->getClientOriginalName());
       $file->move($this->baseDir, $imageName);
   }

   public function text123(){
       return '123';
   }

   public function isAdmin($userId){
	   //return $user->roles->all();
	   //echo $this->user; exit;
	   // dd($this->find($userId));
	   // return $this->find($this->id)->roles->toArray();
	   // return 'test';
	    $user = User::find($userId)->roles->toArray();
		if($user && $user[0]['name']=='Admin'){
			return 'Yes';
		}
		return 'No';
   }
}
