<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerPaymentValidation extends FormRequest
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
            'worker_id'      => 'required',
            'amount'        => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'worker_id.required'    => 'Select A Worker',  
          'amount.required'       => 'Amount is required',
        ];
    }
}
