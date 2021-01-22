<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DueValidation extends FormRequest
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
            'ref'     => 'required',
            'amount'  => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'ref.required'           => 'Reference is required', 
          'amount.required'        => 'Amount is required',
        ];
    }
}
