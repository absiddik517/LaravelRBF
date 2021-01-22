<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerValidation extends FormRequest
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
            'name'        => 'required',
            'address'     => 'required',
            'phone'       => 'required|unique:workers',
            'selery'      => 'required',
            'designation' => 'required',
        ];
    }

    public function messages()
    {
        return [  
          'name.required'      => 'Name is required',  
          'address.required'   => 'Address is required',
          'phone.required'     => 'Phone is required',
          'phone.unique'       => 'Phone is already exist',
          'selery.required'    => 'Selery is required',
          'designation.required'=> 'Designation is required',
        ];
    }
}
