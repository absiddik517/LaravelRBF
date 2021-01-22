<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyDailyAdvanceValidation extends FormRequest
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
            'party_id'      => 'required',
            'description'   => 'required',
            'amount'        => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'party_id.required'      => 'Select a party',  
          'description.required'   => 'Description is required',   
          'amount.required'        => 'Amount is required',   
        ];
    }
}
