<?php

namespace App\Http\Controllers\ADM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Student;
use App\Models\User;
use App\Models\Education;
use App\Models\Admission_form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
class Admissioncontroller extends Controller
{
    public function activeDepartment()
    {
        return Section::where('status', 1)->get();
    }
    public function getShiftGroup($id)
    {
        return Batch::where('id', $id)->get();
    }


    public function admissionStore(StudentRequest $request)
    {

       
           
        try {

            DB::transaction(function () use ($request) {

                 $s_files = $request->file('s_photo');
                 $birth_certificate_file = $request->file('birth_certificate_photo');
                 $f_files = $request->file('f_photo');
                 $g_files = $request->file('g_photo');

                if ($s_files) {

                    $extension = $s_files->getClientOriginalExtension();
                    $s_file_name = time() . '_' . Str::random(10) . '.' . $extension;
                    $s_files->move(public_path('images/student_photo'), $s_file_name);
                }
                if ($birth_certificate_file) {

                    $extension = $birth_certificate_file->getClientOriginalExtension();
                    $s_birth_certificate_file = time() . '_' . Str::random(10) . '.' . $extension;
                    $birth_certificate_file->move(public_path('images/birth_certificate_photo'), $s_birth_certificate_file);
                }
                if ($g_files) {

                    $extension = $g_files->getClientOriginalExtension();
                    $g_file_name = time() . '_' . Str::random(10) . '.' . $extension;
                    $g_files->move(public_path('images/guardian_photo'), $g_file_name);
                }
                if ($f_files) {

                    $extension = $f_files->getClientOriginalExtension();
                    $f_file_name = time() . '_' . Str::random(10) . '.' . $extension;
                    $f_files->move(public_path('images/father_photo'), $f_file_name);
                }

                $validatedData = $request->validated();            
                $validatedData['entry_by'] = auth()->user()->id;
                $validatedData['entry_date'] = now();
                $validatedData['entry_ip_address'] = $request->ip();
                $validatedData['birth_certificate_photo'] = $s_birth_certificate_file;
                $validatedData['s_photo'] = $s_file_name;
                $validatedData['g_photo'] = $g_file_name;
                $validatedData['f_photo'] = $f_file_name;
        
                Student::insert($validatedData);        

                Admission_form::where('form_number',$request->adm_frm_sl)->update([
                'roll' => $request->roll_no,
                'reg_code' => $request->reg_no, 
                'admission_date' => Carbon::now()->format('Y-m-d'), 
                'admission_by' => auth()->user()->id,
                ]);            
                
               

            });
            return response()->json(['message' => 'Student Admission Successfull'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
    public function departmentWiseStudent(Request $request,$dept_id,$batch_id){
        try {

           return Student::with('department','batch')->where('DEPARTMENT_ID',$dept_id)->where('BATCH_ID',$batch_id)->get();
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          }
    }
    public function searchStudent($item){
        try {           
           return Student::with('department','batch')
            ->where('reg_no', 'LIKE', "%" . $item . "%")                
            ->orWhere('student_name_bangla', 'LIKE', "%" . $item . "%")
            ->orWhere('student_name_english', 'LIKE', "%" . $item . "%")
       ->get();
          
          } catch (\Exception $e) {          
              return $e->getMessage();
          }
    }
    public function studentEdit($id){
        try {              
           return Student::with('education')->where('id',$id)->first();     
          
          } catch (\Exception $e) {          
              return $e->getMessage();
          }
    }
    public function studentUpdate(StudentUpdateRequest $request,$id){
        try {        

           $student = Student::findOrFail($id);              
   
           $student->update($request->validated()); 
            
            return response()->json(['message' => 'Student Update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
