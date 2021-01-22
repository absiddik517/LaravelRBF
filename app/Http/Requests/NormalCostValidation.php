<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Money;
class NormalCostValidation extends FormRequest
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
            'description'     => 'required',
            'amount'          => 'required|integer|max:'.Money::Cash()
        ];
    }

    public function messages()
    {
        return [  
          'description.required'   => 'Description is required', 
          'amount.required'        => 'Amount is required',
          'amount.integer'         => 'Amount should be integer',
          'amount.max'             => 'Not enough balance : balance is '.Money::Cash(),
        ];
    }
    
}
