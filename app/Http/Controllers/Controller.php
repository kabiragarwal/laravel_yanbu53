<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $signedIn;

    protected $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            $this->signedIn = Auth::check();

            return $next($request);
        });
        // $this->user = Auth::User();
        // $this->signedIn = Auth::check();

        // view()->share('user', $this->user);
        // view()->share('signedIn', Auth::check());
    }
}
