<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;
class UpdateAdRequest extends FormRequest
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
        $rules = [
            'subcategory_id' => 'required',
            'type' => 'required',
            'title' => 'required',
            'status' =>'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'terms' => 'accepted',
            'picture.*' => 'image',
        ];

        if(Product::find($this->request->get('id'))->images->count()==0){
            $rules['picture.*'] = 'required|image';
        }
        return $rules;
    }

    public function messages() {
        return [
            'picture.*.required' => 'The image field is required.',
            'subcategory_id.required' => 'The category field is required.',
        ];
    }
}
