<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Purpose extends FormRequest
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
            'name' => 'required',            
            'payment_type' => 'required',
            'type' => 'required',
            'fund_id' => 'required|exists:funds,id', 
        ];
    }

    public function messages()
    {
        return [
            'fund_id.required' => 'The fund field is required.',            

        ];
    }
}
