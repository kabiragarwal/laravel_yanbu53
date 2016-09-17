<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\City;
use App\State;

class LocationController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');

        parent::__construct();
    }

        public function getStatesByCountryId(Request $request){
            $state = State::whereCountryId($request->input('countryId'))->oldest('name')->pluck('name','id')->toArray();
            return $state;
        }

        public function getCitiesByStateId(Request $request){
            $cities = City::whereStateId($request->input('stateId'))->oldest('name')->pluck('name','id')->toArray();
            return $cities;
        }
}
