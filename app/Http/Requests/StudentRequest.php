<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'shift_id' => 'required',
            'group_id' => 'required',
            'adm_frm_sl' => 'required|max:30',               
            'roll_no' => 'required|max:30',               
            'reg_no' => 'required|max:30',

            'student_name_bangla' => 'required|string|max:80',
            'student_name_english' => 'required|string|max:80',
            'blood_group' => 'required|max:4',               
            'gender' => 'required|max:1',
            'dob' => 'required',
            'std_birth_no' => 'required',
            'permanent_add' => 'required',
            'mailing_add' => 'required',            
           
            'f_name' => 'required|string|max:80',
            'f_cellno1' => 'required|numeric',
            'f_cellno2' => 'nullable|numeric',
            'f_occu' => 'nullable|string|max:50',
            'f_nid_no' => 'required|numeric',
            'm_name' => 'required|string|max:80',
            'm_cellno1' => 'required|numeric',
            'm_cellno2' => 'nullable|numeric',
            'm_occu' => 'nullable|string|max:50',
            'm_nid_no' => 'required|numeric',
            'g_name' => 'nullable|string|max:50',
            'g_cellno1' => 'required|numeric',
            'g_cellno2' => 'nullable|numeric',
            'g_occu' => 'nullable|string|max:50',
            'g_nid_no' => 'required|string|max:50',
            'guardian_add' => 'required',
            'previous_institute' => 'required',
            'last_program_of_study' => 'required',
            'name_of_examiner' => 'required',
            'remark_of_examiner' => 'required',
            'institute_add' => 'required',
          
           
            's_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
            'f_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
            'g_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
            'birth_certificate_photo' => 'required|mimes:jpeg,jpg,png|max:2048',
        ];
    }



    public function messages()
    {
        return [
            'department_id.required' => 'The department field is required.',
            'batch_id.required' => 'The batch field is required.',
            'shift_id.required' => 'The shift field is required.',
            'group_id.required' => 'The group field is required.',
            'roll_no.required' => 'The roll field is required.',
            'reg.required' => 'The reg field is required.',
            'f_name.required' => 'The father name field is required.',
            'm_name.required' => 'The mother name field is required.',
            'f_cellno1.required' => 'This field is required.',
            'm_cellno1.required' => 'This field is required.',
            'g_cellno1.required' => 'This field is required.',
            'institute_add.required' => 'This field is required.',
            'guardian_add.required' => 'This field is required.',
            'g_occu.required' => 'This field is required.',
            'f_occu.required' => 'This field is required.',
            'g_occu.required' => 'This field is required.',
            'permanent_add.required' => 'This field is required.',
            'mailing_add.required' => 'This field is required.',
            'g_nid_no.required' => 'This field is required.',
            'm_nid_no.required' => 'This field is required.',
            

        ];
    }
}
