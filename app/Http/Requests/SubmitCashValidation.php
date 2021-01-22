<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitCashValidation extends FormRequest
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
            'owner_id'        => 'required|integer',
            'description'     => 'required',
            'amount'          => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'description.required'   => 'Description is required', 
          'amount.required'        => 'Amount is required',
          'owner_id.required'      => 'Select a owner to submit this amount',
          'owner_id.integer'       => 'You have made change to dom'
        ];
    }
}
