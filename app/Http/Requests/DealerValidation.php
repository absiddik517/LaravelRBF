<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealerValidation extends FormRequest
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
            'name'          => 'required|unique:dealers',
            'title'         => 'required',
            'address'       => 'required',
            'phone'         => 'required|unique:dealers'
        ];
    }

    public function messages()
    {
        return [  
          'name.required'          => 'Name is required',  
          'name.unique'            => 'Name already exist',  
          'title.required'         => 'Title is required',
          'adddress.required'      => 'Address is required',
          'phone.required'         => 'Phone is required',
          'phone.unique'           => 'Phone already exist',
        ];
    }
}
