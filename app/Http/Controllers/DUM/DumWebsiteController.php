<?php

namespace App\Http\Controllers\DUM;
use App\Models\Student;
use App\Models\DUM\Blog;
use App\Models\Employee;

use App\Models\DUM\Event;
use App\Models\DUM\notice;
use App\Models\DUM\Slider;
use App\Models\DUM\Contact;
use App\Models\DUM\Gallery;
use App\Models\DUM\Program;
use Illuminate\Http\Request;
use App\Models\DUM\Committee;
use App\Models\DUM\Facilitie;
use App\Models\DUM\TutionFee;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\NoticeResource;
use App\Models\Course;
use App\Models\Section;

class DumWebsiteController extends Controller
{  
    public function SliderShow()
    {
        try {
            return Slider::where('status',1)->get();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function FacilitieShow()
    {
        try {
            return Facilitie::where('status',1)->get();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function NoticeShow()
    {
        try {
            return NoticeResource::collection(notice::where('status',1)->orderBy("id","desc")->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function NoticeDetails($id)
    {
        try {
            return NoticeResource::collection(notice::where('id',$id)->where('status',1)->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function EventDetails($id)
    {
        try {
            return NoticeResource::collection(notice::where('status',1)->where('id',$id)->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function EventShow()
    {
        try {
            return EventResource::collection(Event::where('status',1)->orderBy("id","desc")->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function ProgramShow()
    {
        try {
            return Section::where('status',1)->get();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function TutionFeeShow()
    {
        try {
            return TutionFee::where('status',1)->get()->groupBy('type');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function TeachingStaffShow()
    {
        try {
            return Employee::with('relDesignation','relDepartment','relSocial')->where('department_id',8)->where('status',1)->get();
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function BlogShow()
    {
        try {
            return BlogResource::collection(Blog::where('status',1)->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function BlogDetails($id)
    {
        try {
            return BlogResource::collection(Blog::where('id',$id)->where('status',1)->get());
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function CommitteeShow()
    {
        try {
            return Committee::where('status',1)->get()->groupBy('committee_type');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function GalleryShow()
    {
        try {
            return Gallery::get()->groupBy('type');
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function studentInfo($id)
    {
        $student = Student::with('department','batch')->find($id);
        if($student) 
        {
        return [
            'name'=>$student->student_name_english ?? 'NA',
            'roll'=>$student->roll_no ?? 'NA',
            'reg_no'=>$student->reg_no ?? 'NA',
            'department'=>$student->department[0]['department_name'] ?? 'NA',
            'batch'=>$student->batch->batch_name ?? 'NA',
            'shift'=>$student->shift_id ?? 'NA',
            'group'=>$student->group_id ?? 'NA',
            'session'=>$student->batch->session ?? 'NA',
            'gender'=>$student->gender ?? 'NA',
            'dob'=>$student->dob ?? 'NA',
            'blood_group'=>$student->blood_group ?? 'NA',
            'photo'=>$student->s_photo ?? 'NA',
            

        ];
    }else{
        return response()->json(['error' => 'Not found', 'status'=>404]);;
    }

    }
    public function studentSearch($searchTerm)
    {
        $student = Student::with('department','batch')->where('status',1)->where(function ($query) use ($searchTerm) {            
            $query->where('id','like',"%$searchTerm%")                  
                  ->orwhere('student_name_english', 'like', "%$searchTerm%")
                  ->orWhere('reg_no', 'like', "%$searchTerm%");
        })->first();
        if($student) 
        {
        return [
            'id'=>$student->id ?? 'NA',
            'name'=>$student->student_name_english ?? 'NA',
            'roll'=>$student->roll_no ?? 'NA',
            'reg_no'=>$student->reg_no ?? 'NA',
            'department'=>$student->department[0]['department_name'] ?? 'NA',
            'batch'=>$student->batch->batch_name ?? 'NA',
            'shift'=>$student->shift_id ?? 'NA',
            'group'=>$student->group_id ?? 'NA',
            'session'=>$student->batch->session ?? 'NA',
            'gender'=>$student->gender ?? 'NA',
            'dob'=>$student->dob ?? 'NA',
            'blood_group'=>$student->blood_group ?? 'NA',
            'photo'=>$student->s_photo ?? 'NA',
            

        ];
    }else{
        return response()->json(['error' => 'Not found', 'status'=>404]);;
    }

    }

    public function studentVerify($id)
    {
        $student = Student::with('department','batch')->where('status',1)->where('id',$id)->first();
        if($student) 
        {
        return [
            'id'=>$student->id ?? 'NA',
            'name'=>$student->student_name_english ?? 'NA',
            'roll'=>$student->roll_no ?? 'NA',
            'reg_no'=>$student->reg_no ?? 'NA',
            'department'=>$student->department[0]['department_name'] ?? 'NA',
            'batch'=>$student->batch->batch_name ?? 'NA',
            'shift'=>$student->shift_id ?? 'NA',
            'group'=>$student->group_id ?? 'NA',
            'session'=>$student->batch->session ?? 'NA',
            'gender'=>$student->gender ?? 'NA',
            'dob'=>$student->dob ?? 'NA',
            'blood_group'=>$student->blood_group ?? 'NA',
            'photo'=>$student->s_photo ?? 'NA',
            

        ];
    }else{
        return response()->json(['error' => 'Not found', 'status'=>404]);;
    }

    }

    public function employeeInfo($id)
    {
      
        try {           
             $employee = Employee::with('relDesignation', 'relDepartment', 'relSocial', 'relTraining', 'relQualification')->find($id);
            if($employee){
                return $employee;
            }else{
                return response()->json(['error' => 'Not found', 'status'=>404]);
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function employeeSearch($searchTerm)
    {
      
        try {           
             $employee = Employee::with('relDesignation', 'relDepartment', 'relSocial', 'relTraining', 'relQualification')->where(function ($query) use ($searchTerm) {
                $query->where('id','like', "%$searchTerm%")
                      ->orwhere('name', 'like', "%$searchTerm%")
                      ->orWhere('email', 'like', "%$searchTerm%");
                    //   ->orWhere('personal_phone_no', 'like', "%$searchTerm%");
            })->first();
            if($employee){
                return $employee;
            }else{
                return response()->json(['error' => 'Not found', 'status'=>404]);
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function getProfileId()
    {
        return Employee::select('id')->get();

    }
    public function getStudentsId()
    {
        return Student::where('status',1)->select('reg_no')->limit(150)->get();

    }
    public function getCounter(){
        $activeStudents = Student::where('status',1)->count();
        $nonActiveStudents = Student::where('status',0)->count();
        $teacher = Employee::where('department_id',8)->count();
        $staff = Employee::whereNotIn('department_id', [8, 10])->count();
     
        return [
            'sum_of_active_students'=>$activeStudents ?? 'NA',
            'sum_of_not_active_students'=>$nonActiveStudents ?? 'NA',
            'teacher'=>$teacher ?? 'NA',
            'staff'=>$staff ?? 'NA',
         
        ];
        
    }




    public function SendMessage(Request $request){
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required',                       
            
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->subject = $request->subject;
        $contact->email= $request->email;
        $contact->message = $request->message;
        $contact->save();
        return response()->json(['message'=>"Message Send Successfully"],200);


    }
}
