<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreloadValidation extends FormRequest
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
            'item_id'      => 'required',
            'quantity'     => 'required',
            'amount'       => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'item_id.required'      => 'Select an item.',  
          'quantity.required'     => 'Quantity is required.',   
          'amount.required'       => 'Amount is required',   
        ];
    }
}
