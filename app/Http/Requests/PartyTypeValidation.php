<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyTypeValidation extends FormRequest
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
            'name'          => 'required|unique:party_types',
            'billing_system'=> 'required',
            'task'          => 'required',
            'allow_advance' => 'required',
            'allow_daily_advance' => 'required',
            'allow_preload' => 'required',
        ];
    }

    public function messages()
    {
        return [  
          'name.required'          => 'Name is required',  
          'name.unique'            => 'Name already exist',  
          'billing_system.required'=> 'Select Billing System',
          'task.required'          => 'Task is required',
          'allow_advance.required' => 'Would you allow advance to this party',
          'allow_daily_advance.required' => 'Would you allow daily advance to this party',
          'allow_preload.required' => 'Would you allow preloaded item to this party',
        ];
    }
}
