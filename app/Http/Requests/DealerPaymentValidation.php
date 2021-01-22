<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealerPaymentValidation extends FormRequest
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
            'dealer_id'     => 'required',
            'provider'      => 'required',
            'amount'        => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'dealer_id.required'     => 'Select a dealer',  
          'amount.required'        => 'Amount is required',
          'provider.required'      => 'Provider is required',
        ];
    }
}
