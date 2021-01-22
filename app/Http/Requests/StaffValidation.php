<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffValidation extends FormRequest
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
            'name'          => 'required|unique:staff',
            'address'       => 'required',
            'phone'         => 'required|unique:staff',
            'designation'   => 'required',
            'selery'        => 'required',
        ];
    }

    public function messages()
    {
        return [  
          'name.required'          => 'Name is required',  
          'name.unique'            => 'Name already exist',  
          'adddress.required'      => 'Address is required',
          'phone.required'         => 'Phone is required',
          'phone.unique'           => 'Phone already exist',  
          'designation.required'   => 'Designation is required',
          'selery.required'        => 'Selery is required',
        ];
    }
}
