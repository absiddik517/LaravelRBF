<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutcashValidation extends FormRequest
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
            'is_owner'        => 'required',
            'name'            => 'required',
            'address'         => 'required_if:is_owner,No',
            'phone'           => 'required_if:is_owner,No',
            'description'     => 'required',
            'amount'          => 'required|integer',
        ];
    }

    public function messages()
    {
        return [  
          'is_owner.required'   => 'Select Outcash Type', 
          'name.required'       => 'Name is required',
          'Address.required_if' => 'Address is required',
          'phone.required_if'   => 'Phone is required',
          'description.required'=> 'Description is required',
          'amount.required'     => 'Amount is required',
          'amount.integer'      => 'Amount Should be integer',
        ];
    }
}
