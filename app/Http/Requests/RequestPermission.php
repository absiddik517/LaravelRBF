<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPermission extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rule_id'           => 'required',
            'insert_access'     => 'required',
            'update_access'     => 'required',
            'delete_access'     => 'required',
            'rule_access'       => 'required',
            'permission_access' => 'required',
            'user_access'       => 'required'
        ];
    }

    public function messages()
    {
        return [  
          'name.min'                => 'must be atleast 4 desiget',  
          'rule_id.required'        => 'Select A Rule Name',  
          'insert_access.required'  => 'Select Insert Permission',  
          'update_access.required'  => 'Select Update Permission',  
          'delete_access.required'  => 'Select Delete Permission',  
          'rule_access.required'    => 'Select Rule Permission',  
          'permission_access.required'    => 'Select Permission Access',  
          'user_access.required'    => 'Select User Access'
        ];
    }
}
