<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectPaymentValidation extends FormRequest
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
            'description'   => 'required|min:4',
            'amount'        => 'required',
        ];
    }

    public function messages()
    {
        return [  
          'description.required'   => 'Description is required.',  
          'description.min'        => 'Description must be above 3 chars.',  
          'amount.required'        => 'Amount is required.',
        ];
    }
}
