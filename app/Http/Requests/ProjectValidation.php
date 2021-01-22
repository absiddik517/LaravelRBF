<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectValidation extends FormRequest
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
            'title'         => 'required|unique:projects',
            'location'      => 'required',
            'owner'         => 'required',
            'phone'         => 'required',
            'email'         => 'email',
        ];
    }

    public function messages()
    {
        return [  
          'title.required'         => 'Title is required',  
          'title.unique'           => 'Title already exist',  
          'location.required'      => 'Location is required',
          'phone.required'         => 'Phone is required',  
          'email.email'            => 'Email is not valid',
        ];
    }
}
