<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;

class CountriesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $countries = Country::latest()->get();
        return view('admins.country.index', compact('countries'));
    }

    public function create() {
        return view('admins.country.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required', 'slug' => 'required']);
        $country = Country::create($request->all());

        flash()->success("Success! Country data has been created.");
        return redirect('admin/country/edit/'.$country->id);
    }

    public function edit(Country $country) {
        return view('admins.country.edit', compact('country'));
    }

    public function update(Request $request) {
        $this->validate($request, ['name' => 'required', 'slug' => 'required']);
        $country = Country::find($request->input('id'));
        $country->update($request->input());

        flash()->success("Success! Country data has been updated.");
        return redirect()->back();
    }

    public function view(Country $country) {
        return view('admins.country.view', compact('country'));
    }

    public function destroy(Country $country){
        Country::destroy($country->id);
        flash()->success("Success! Country is deleted.");
        return redirect()->back();
    }
}
