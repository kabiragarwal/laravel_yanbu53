<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;

class StatesController extends Controller
{
    public function __construct(){
		$this->middleware('admin');

		parent::__construct();
	}

    public function index(){
        $states = State::with('country')->latest()->get();

        return view('admins.state.index', compact('states'));
    }

    public function create() {
        $countryList = $this->countryList();
        return view('admins.state.create', compact('countryList'));
    }

    public function store(Request $request) {
        $this->validate($request, ['country_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $state = State::create($request->all());
        flash()->success("Success! State data has been created.");
        return redirect('admin/state/edit/'.$state->id);
    }

    public function edit(State $state) {
        $countryList = $this->countryList();
        return view('admins.state.edit', compact('state','countryList'));
    }

    public function update(Request $request) {
        $this->validate($request, ['country_id' => 'required', 'name' => 'required', 'slug' => 'required']);
        $state = State::find($request->input('id'));
        $state->update($request->input());

        flash()->success("Success! State data has been updated.");
        return redirect()->back();
    }

    public function view(State $state) {
        return view('admins.state.view', compact('state'));
    }

    public function destroy(State $state){
        State::destroy($state->id);
        flash()->success("Success! State is deleted.");
        return redirect()->back();
    }

    public function countryList(){
        $country = new Country;
        $country = $country->getAllCountry();
        return $country;
    }
}
