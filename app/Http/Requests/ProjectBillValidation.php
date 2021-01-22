<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectBillValidation extends FormRequest
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
            'first_date'        => 'required',
            'last_date'         => 'required',
            'sub_total'         => 'required|min:1',
            'advance_cutting'   => 'required',
            'transport'         => 'required|min:1',
            'previous_due'      => 'required',
            'total'             => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [  
          'first_date.required'    => 'First date is required',  
          'last_date.required'     => 'Last date is required',  
          'sub_total.required'     => 'Product price is required',
          'sub_total.min'          => 'Product price must be above 1 taka',
          'advance_cutting.required'  => 'Advance cutting amount is required.',  
          'transport.required'     => 'Transport cost is required.',
          'transport.min'          => 'Transport cost must be above 1 taka.',
          'previous_due.required'  => 'Previous due is required.',
          'total.required'         => 'Total is required.',
          'total.min'              => 'Total must be avobe 1 taka.',
        ];
    }
}
