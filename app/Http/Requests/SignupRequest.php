<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
        return [
            'user_type' =>'required',
            'first_name' =>'required|max:100',
            'last_name' =>'required|max:100',
            'phone' =>'required|numeric',
            'gender' =>'required',
            'email' =>'required|email|unique:users|max:100',
            'password' =>'required|min:5|confirmed',
            'terms' =>'required',
        ];
    }
}
