<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeEnrtyRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [            
                'department_id' => 'required|integer',
                'batch_id' => 'required|integer',
                'student_id' => 'required',
                'purpose_id' => 'required',
                'pay_by' => 'required',
                'amount' => 'required',
                'receipt_no' => 'required',
                'date' => 'required',
                'note' => 'nullable',                  
            
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'The department field is required.',
            'batch_id.required' => 'The batch field is required.',
            'student_id.required' => 'The student field is required.',
            'purpose_id.required' => 'The purpose field is required.',         
            
        ];
    }
}
