<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Page;
use App\Product;
use App\Category;
use App\City;
use App\State;
use App\Country;
use App\Subcategory;

class AdminsController extends Controller
{
	public function __construct(){
			$this->middleware('admin', ['except' => array('admin_login','post_admin_login')]);

			parent::__construct();
	}

    public function dashboard(){


		$users = User::count();
		$page = Page::count();
		$product = Product::active()->count();
		$category = Category::count();
		$city = City::count();
		$state = State::count();
		$country = Country::count();
		$subcategory = Subcategory::count();
		//pr($users);
        return view('admins.dashboard', compact('users','page','product','category','city','state','country','subcategory'));
    }

	public function admin_login(){
        return view('admins.login');
    }

	public function admin_logout() {
        Auth::logout();
        flash()->success('Your are log out.');
        return redirect('admin/admin_login');
    }

	public function post_admin_login(Request $request) {
        $this->validate($request, [ 'email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($this->getcredentials($request))) {
            flash()->success('Your are loggedin.');
            return redirect('admin/dashboard');
        }
        flash()->error("Something is wrong, Your credentials are doesn't matched.");
        return redirect()->back();
    }

    public function getcredentials(Request $request) {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
    }


}
