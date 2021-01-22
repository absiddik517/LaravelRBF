<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Delivery extends FormRequest
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
            'ref'     => 'required',
            'd_ref'   => 'required|unique:delevery_products',
            'quantity'=> 'required',
            'driver'  => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'ref.required'           => 'Reference is required',  
          'd_ref.unique'           => 'Delivery No already exist',  
          'd_ref.required'         => 'Delivery No is required',
          'quantity.required'      => 'Quantity is required',
          'driver.required'        => 'Driver is required',
        ];
    }
}
