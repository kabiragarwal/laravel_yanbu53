<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\City;
use App\State;
use App\Country;
use App\Http\Requests\ProfileUpdateRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UsersController extends Controller
{
    protected $baseDir = 'upload/users';

    public function __construct(){
			$this->middleware('admin');

			parent::__construct();
	}

    public function users(){
		$users= User::where('email','!=','Admin@yanbu.com')->with('city', 'state', 'country')->latest()->get();
		return view('admins.user.index', compact('users'));
	}

    public function user_view(User $user){
        $userData = $user;
        //dd($user);
        $countryList = Country::pluck('name', 'id');
        $stateList = State::pluck('name', 'id');
        $cityList = City::pluck('name', 'id');
		return view('admins.user.view', compact('userData','countryList', 'stateList', 'cityList'));
    }

    public function user_edit(User $user){
        $userData = $user;
        $countryList = Country::pluck('name', 'id');
        $stateList = State::pluck('name', 'id');
        $cityList = City::pluck('name', 'id');
		return view('admins.user.edit', compact('userData','countryList', 'stateList', 'cityList'));
    }

    public function user_update(ProfileUpdateRequest $request) {
        //pr($request->all()); exit;
        $user = User::find($request->input('id'));
        if ($request->file('image')) {
            ($user->image) ? \File::delete('upload/users/' . $user->image) : '';

            $imageName = $this->profilePhotoUpload($request->file('image'));
            $user->update(array('image' => $imageName));
        }
		$user->newsletter = ($request->input('newsletter'))?$request->input('newsletter'):0;
		$user->suggestions = ($request->input('suggestions'))?$request->input('suggestions'):0;
        $user->hide_phone = ($request->input('hide_phone'))?$request->input('hide_phone'):0;
        $user = $user->update($request->input());
        flash()->success("User's profile details are successfully updated.");
        return redirect()->back();
    }

    public function user_delete(User $user){
        User::destroy($user->id);
        flash()->success('Success! User Account is deleted');
        return redirect()->back();
    }

    public function profilePhotoUpload(UploadedFile $file) {
        $imageName = sprintf("%s-%s.%s", time(), str_random(3), $file->getClientOriginalExtension());
        $file->move($this->baseDir, $imageName);
        //User::find($this->user->id)->update(array('image'=>"1470483950.jpg"));
        return $imageName;
    }
}
