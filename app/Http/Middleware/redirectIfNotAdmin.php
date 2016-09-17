<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class redirectIfNotAdmin
{
	protected $user;
	 
    public function handle($request, Closure $next)
    {
		$this->user = new User;
		if(Auth::check() && ($this->user->isAdmin(Auth::id()) == 'Yes')){
			return $next($request);
		}
        return redirect('admin/admin_login');
    }
}
