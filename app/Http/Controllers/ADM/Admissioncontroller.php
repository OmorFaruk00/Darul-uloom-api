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
use App\Models\Registration;

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
                
                Registration::where('reg_code',$request->reg_no)->update(['status'=>0]);

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

            return Student::with('department', 'batch')
            ->where('status',1)
            ->where('DEPARTMENT_ID', $dept_id)
            ->where('BATCH_ID', $batch_id)
            ->orderBy('roll_no', 'ASC') // Sort by roll_no in ascending order
           
            ->get();
          
          } catch (\Exception $e) {
          
              return $e->getMessage();
          }
    }
    public function searchStudent($item){
        try {           
           return Student::with('department','batch')
            ->where('status',1)
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
            
            $validatedData = $request->validated(); 
           $student = Student::findOrFail($id);              
   
           $student->update($validatedData); 
            
            return response()->json(['message' => 'Student Update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

     function searchStudentForImage($item){

      
        try {           
            $students = Student::with('department', 'batch')
                ->where('status',1)
                ->when($item, function ($query) use ($item) {
                    $query->where('reg_no', 'LIKE', "%" . $item . "%")
                          ->orWhere('student_name_bangla', 'LIKE', "%" . $item . "%")
                          ->orWhere('student_name_english', 'LIKE', "%" . $item . "%");
                })
                // ->orderBy('department_id', 'asc') 
                // ->orderBy('batch_id', 'asc')                 
                // ->orderBy('roll_no', 'asc')
                                 
                ->get();
            
            return $students;
        
        } catch (\Exception $e) {          
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    function StudentImageUpdate(Request $request,$id){
        $request->validate([
            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',           
            
        ]);
        
        $student = Student::find($id);      

        if ($request->hasFile('image')) {
           $file = $request->file('image'); 
          

             

        $extension = $file->getClientOriginalExtension();
        $file_name = 'student_profile_photo_' . $id . '.' . $extension;
            $file->move(public_path('images/student_photo'), $file_name);            
        }
        
           
        $student->s_photo = $file_name ?? $student->image;
       
        $student->save();
        return response()->json(['message' => 'Image  Updated Successfully'],200);

    }




    public function registrationNumber(){
        return Registration::where('status',1)->first();
    }
    public function admissionFromCheck($formNumber){
        
        $form = Admission_form::where('form_number',$formNumber)->where('reg_code',null)->whereNotNull('name_of_student')->get();        
        if ($form->count()==0) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
           
        } else {
            return response()->json($form[0], 200);
        }
    }

    public function admissionBatchInfo($batchId){        
        return Batch::findOrFail($batchId);   
       
    }

    public function batchWiseStudentAdmissionInfo($batchId){       
     
        return Student::with('employee')->where('batch_id',$batchId)->get();    
       
    }
}
