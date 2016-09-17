<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //echo Auth::id(); exit;
        $user = User::find(Auth::id());

        $rules =  [
            'user_type' =>'required',
            'first_name' =>'required|max:100',
            'last_name' =>'required|max:100',
            'phone' =>'required|numeric',
            'gender' =>'required',
            'address' =>'required',
            'country_id' =>'required|numeric',
            'city_id' =>'required|numeric',
            'state_id' =>'required|numeric',
            'image' =>'image',
            'email' =>'required|email|max:100',
            'zip_code' =>'required|numeric|min:5',
        ];

        if ($user->notHavingImageInDb()){
            $rules['image'] = 'required|image';
        }

        return $rules;
    }
}
