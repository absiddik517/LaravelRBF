<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffPaymentValidation extends FormRequest
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
            'staff_id'      => 'required',
            'amount'        => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'staff_id.required'      => 'Select A Staff',  
          'amount.required'        => 'Amount is required',
        ];
    }
}
