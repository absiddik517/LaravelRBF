<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellsForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'ref'              => 'required|unique:sells',
            'name'             => 'required|min:4',
            'address'          => 'required',
            'phone'            => 'required',
            'product_id'       => 'required',
            'rate'             => 'required',
            'transport_rate'   => 'required',
            'product_price'    => 'required',
            'transport'        => 'required',
            'total'            => 'required',
            'quantity'         => 'required',
            'total'            => 'required',
        ];
    }

    public function messages()
    {
        return [
          'name.required'       => 'Name is required',
          'ref.required'        => 'Reference is required',  
          'ref.unique'          => 'Reference already exist',  
          'address.required'    => 'Address is required',  
          'phone.required'      => 'Phone is required',  
          'product_id.required' => 'Select a product',  
          'rate.required'       => 'Rate is required',  
          'transport_rate.required'       => 'Transport rate is required',  
          'product_price.required'        => 'Product price is required',  
          'transport.required'  => 'Transport is required',  
          'total.required'      => 'Total is required',  
          'quantity.required'   => 'Quantity is required'  
        ];
    }
}
