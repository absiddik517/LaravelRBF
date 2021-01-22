<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectDeleveryValidation extends FormRequest
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
            'dref'    => 'required|unique:project_deleveries',
            'quantity'=> 'required',
            'driver'  => 'required',
            'product_id'  => 'required'
        ];
    }

    public function messages()
    {
        return [    
          'dref.unique'           => 'Delivery No already exist',  
          'dref.required'         => 'Delivery No is required',
          'quantity.required'      => 'Quantity is required',
          'driver.required'        => 'Driver is required',
          'product_id.required'        => 'Select a product',
        ];
    }
}
