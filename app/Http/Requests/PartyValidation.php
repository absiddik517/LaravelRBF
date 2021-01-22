<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyValidation extends FormRequest
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
            'party_type'    => 'required',
            'name'          => 'required',
            'address'       => 'required',
            'rate'          => 'required',
            'phone'         => 'required|unique:parties',
        ];
    }

    public function messages()
    {
        return [  
          'party_type.required'    => 'Select party type',  
          'name.required'          => 'Name is required',   
          'rate.required'          => 'Rate is required',   
          'address.required'       => 'Address is required',
          'task.required'          => 'Task is required',
          'phone.required'         => 'Phone is required',
          'phone.unique'           => 'Phone number already exist',
        ];
    }
}
