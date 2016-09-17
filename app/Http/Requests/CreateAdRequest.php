<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'subcategory_id' => 'required',
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'terms' => 'accepted',
            'picture.*' => 'required|mimes:jpeg,png,bmp,gif',
        ];
    }

    public function messages() {
        return [
            'picture.*.required' => 'The image field is required.',
            'subcategory_id.required' => 'The category field is required.',
        ];
    }

}
