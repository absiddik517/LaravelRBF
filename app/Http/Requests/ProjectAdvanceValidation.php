<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectAdvanceValidation extends FormRequest
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
            'description'   => 'nullable',
            'amount'        => 'required',
        ];
    }

    public function messages()
    {
        return [    
          'amount.required'        => 'Amount is required.',
        ];
    }
}
