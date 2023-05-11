<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transfer extends FormRequest
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
            'from_fund_id' => 'required',            
            'to_fund_id' => 'required',            
            'amount' => 'required',
            'note' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'from_fund_id.required' => 'The from fund field is required.',            
            'to_fund_id.required' => 'The to fund field is required.',            

        ];
    }
}
