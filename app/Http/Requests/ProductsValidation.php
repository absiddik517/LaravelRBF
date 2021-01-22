<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsValidation extends FormRequest
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

    public function rules()
    {
        return [
            'name'     => 'required|unique:products',
            'rate'     => 'required',
            'transport_rate'     => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'name.required'           => 'Product name is required',  
          'name.unique'             => 'Product already exist',  
          'rate.required'           => 'Rate is required',
          'transport_rate.required' => 'Transport rate is required'
        ];
    }
}
