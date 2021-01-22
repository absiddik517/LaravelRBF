<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// App\Http\Requests\PartyProductionValidation;

class PartyProductionValidation extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description'     => 'required',
            'quantity'        => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'description.required'    => __('val.des_req'),
          'quantity.required'       => __('val.quantity_req'),
        ];
    }
}
