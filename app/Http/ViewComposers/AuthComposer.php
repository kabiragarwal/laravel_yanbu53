<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthComposer
{
    public $user;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //dd($this->user);
        //view composer method
        $view->with('signedIn', Auth::guest());
        //view()->share('user', Auth::user());
        $view->with('user', $this->user);
        //$view->with('latestMovie', end($this->movieList));
    }
}
