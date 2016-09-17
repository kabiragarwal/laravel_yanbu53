<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAbuseRequest extends FormRequest
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
            'product_report_reason_id' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'product_id' => 'required',
        ];
    }

    public function messages(){
        return [
                'product_report_reason_id.required' => 'The reason field is required'
        ];
    }


}
