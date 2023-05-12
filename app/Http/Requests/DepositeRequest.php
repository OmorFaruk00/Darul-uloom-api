<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositeRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [           
                'purpose_id' => 'required',
                'reference_id' => 'required',
                'pay_by' => 'required',
                'amount' => 'required',               
                'date' => 'required',
                'note' => 'nullable',                 
            
        ];
    }

    public function messages()
    {
        return [           
            'purpose_id.required' => 'The purpose field is required.',         
            'reference_id.required' => 'The reference field is required.',         
            
        ];
    }
}
