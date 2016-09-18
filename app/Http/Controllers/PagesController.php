<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\City;
use App\Page;
use App\Product;
use App\Category;
use App\Subcategory;
//use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\ContactRequest;
use App\Notifications\ForgetPasswordNotifications;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsEmail;
use App\notifications\ConfirmSignupNotifications;

class PagesController extends Controller {


    public function home() {
        $category = Category::with('subCategory')->withCount('product')->get();
        $cityList = City::all()->take(16);
        $slug = 'featured';
        $product = Product::whereHas('premium_ad', function($query) use($slug) {
                $query->where('slug', $slug);
        })->active()->with('FirstImage')->get();

        return view('pages.home', compact('category','cityList','product'));
    }

    public function about_us() {
        $pages = Page::whereSlug('about-us')->first();
        return view('pages.about_us', compact('pages'));
    }

    public function faq() {
        $pages = Page::whereSlug('faq')->first();
        return view('pages.faq', compact('pages'));
    }

    public function contact() {
        return view('pages.contact_us');
    }

    public function privacy_policy() {
        $pages = Page::whereSlug('privacy-policy')->first();
        return view('pages.privacy-policy', compact('pages'));
    }

    public function terms() {
        $pages = Page::whereSlug('terms-and-conditions')->first();
        return view('pages.terms-and-conditions', compact('pages'));
    }

    public function signup() {
        if ($this->signedIn) {
            return redirect('/profile');
        }

        return view('pages.signup');
    }

    public function signin() {
        if ($this->signedIn) {
            return redirect('/profile');
        }

        return view('pages.signin');
    }

    public function forgot_password() {
        if ($this->signedIn) {
            return redirect('/profile');
        }
        return view('pages.forgot_password');
    }

    public function post_signup(SignupRequest $request) {
        $user = User::create($request->input());
        $response = $user->notify(new ConfirmSignupNotifications($user));
        //$mailers->sendConfirmationEmail($user);
        flash()->success('Your account has been created. Please confirm your email address.');
        return redirect()->back();
    }

    public function post_contact(ContactRequest $request){
        $userInstance = new User;
        $data = $request->all();
        Mail::to('mglrahul@gmail.com')->send(new ContactUsEmail($data));

        //$mailers->contactUsEmail($request->all());
        flash()->success('Thanks for contacting us.');
        return redirect()->back();
    }

    public function confirmEmail($token) {
        $user = User::whereToken($token)->firstOrFail()->confirmEmail();

        return view('pages.user-confirmed');
    }

    public function post_signin(Request $request) {
        $this->validate($request, [ 'email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($this->getcredentials($request))) {
            flash()->success('Your are loggedin.');
            return redirect ()->intended('/profile');
            //return redirect('/profile');
        }
        flash()->error("Something is wrong, Your credentials are doesn't matched.");
        return redirect()->back();
    }

    public function getcredentials(Request $request) {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'verified' => 1,
        ];
    }

    public function post_forgot_password(Request $request) {
        $this->validate($request, [ 'email' => 'required|email']);
        $user = User::whereEmail($request->input('email'))->first();
        if (!$user) {
            flash()->error("No record Exist for this Email id.");
            return redirect()->back();
        }

        $user->token = str_random(30);
        $user->save();

        //$userClass = new User;
        $response =$user->notify(new ForgetPasswordNotifications($user));
        //dd($response);
        //$mailers->passwordResetEmail($user);

        flash()->success(" An email has been sent to provided email address, Please check your inbox.");
        return redirect()->back();
    }

    public function password_reset($token) {
        $userData = User::whereToken($token)->first();
        if (!$userData) {
            flash()->error("Something is wrong, Please try again.");
            return redirect('forgot_password');
        }
        return view('pages.password_reset', compact('userData'));
    }

    public function post_password_reset(Request $request) {
        $this->validate($request, ['password' => 'required|confirmed']);
        User::whereToken($request->input('token'))->firstOrFail()->updatePassword($request->input('password'));

        flash()->success("Your password has been reset, Now you can access your account.");
        return redirect('signin');
    }
}
