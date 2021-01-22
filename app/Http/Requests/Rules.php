<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rules extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|min:4|unique:rules',
        ];
    }

    public function messages()
    {
        return [
          'name.required'           => 'name Is required',  
        ];
    }
}
