<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\City;
use App\State;
use App\Country;

class CitiesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $cities = City::with('state')->latest()->get();

        return view('admins.city.index', compact('cities'));
    }

    public function create() {
        $stateList = $this->stateList();
        $countryList = $this->countryList();
        return view('admins.city.create', compact('stateList','countryList'));
    }

    public function store(Request $request) {
        $this->validate($request, ['country_id' => 'required', 'state_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $city = City::create($request->all());
        flash()->success("Success! City data has been created.");
        return redirect('admin/city/edit/'.$city->id);
    }

    public function edit(City $city) {
        $stateList = $this->stateList();
        $countryList = $this->countryList();
        //echo $city[0]->state->country_id;
        $city['country_id'] = $city->state->country_id;
        //pr($city);
        //echo $city->state->country_id;
        //exit;
        return view('admins.city.edit', compact('city','stateList','countryList'));
    }

    public function update(Request $request) {
        $this->validate($request, ['country_id' => 'required', 'state_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $city = City::find($request->input('id'));
        $city->update($request->input());

        flash()->success("Success! City data has been updated.");
        return redirect()->back();
    }

    public function view(City $city) {
        return view('admins.city.view', compact('city'));
    }

    public function destroy(City $city){
        City::destroy($city->id);
        flash()->success("Success! City is deleted.");
        return redirect()->back();
    }

    public function stateList(){
        $state = new State;
        $state = $state->getAllState();
        return $state;
    }

    public function countryList(){
        $country = new Country;
        $country = $country->getAllCountry();
        return $country;
    }
}
