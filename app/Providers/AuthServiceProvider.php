<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Product;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('own-product', function($user, $product) {
            return $user->owns($product);
            //return $user->id == $article->user_id;
        });

        Gate::define('not-own-product', function($user, $product) {
            if(isset($user) && ($user->id)>0 && $user->owns($product)){
                return false;
            }
            return true;
            //return $user->id == $article->user_id;
        });

        Gate::define('add-premium', function($user, $product) {
            if($user->owns($product)){
                if($product->premium_ad()->pluck('name')->count()>0){
                    return false;
                }
                 return true;
            }
            return false ;
             //return $user->id == $article->user_id;
        });
    }
}
