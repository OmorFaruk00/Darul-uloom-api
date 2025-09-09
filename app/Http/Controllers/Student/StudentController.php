<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\Accounts\StudentCost;
use App\Models\Student;
use App\Models\Attendance_data;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    function studentShow()
    {
        try {
            return Student::with('department', 'batch')->where('status',1)->paginate('20');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    function getStudents(){
        return $student = Student::with('dept', 'batch')->get();
    
        $students = Student::with('dept', 'batch')->get()->transform(function ($student) {
            return [
                'id' => $student->id ?? 'na',
                'name' => $student->student_name_english ?? 'na',
                'reg_code' => $student->reg_no,
                'roll' => $student->roll_no,
                'department' => $student->dept->department_name ?? 'na',
                'batch' => $student->batch->batch_name,
                'batch' => $student->batch->batch_name,
            ];
        });
        return $students;
    }
    function courseShow($id)
    {
        try {
            return Course::where('department_id', $id)->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    function courseCodeShow($item)
    {
        try {
            // return $id;
            return Course::where('course_name', $item)->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function studentStatement($sid)
    {
        // all summery
        $scost = StudentCost::whereHas('transactionable')->with(['relFeeType:id,name,amount', 'transactionable' => function ($query) {
            return $query->select('id', 'amount', 'type', 'trans_type', 'lilha_pay', 'scholarship', 'scholarship_type', 'transactionable_type', 'transactionable_id');
        }, 'relBatch:id,tution_fee,common_scholarship'])->where('student_id', $sid)->get();
        $student = Student::with('batch')->where('id',  $sid)->firstOrFail();
        $total_scholarship = $scost->sum('scholarship');
        $common_scholarship = $student->batch->common_scholarship;
        $summary = [];
        $summary['total_fee'] = (int)$student->batch->tution_fee;
        $summary['total_scholarship'] = $total_scholarship + $common_scholarship;
        $moneyGiven = $scost->sum('amount') - ((int)$scost->sum('transactionable.lilha_pay') + (int)$scost->sum('scholarship'));
        $summary['total_paid'] = $moneyGiven;
        $currentDue = (int)$summary['total_fee'] - (int)$summary['total_scholarship'] - (int)$summary['total_paid'];
        $summary['current_due'] = $currentDue > 0 ? $currentDue : 0;
        return response(['total' => $scost, 'summary' => $summary]);
    }





    public function cardPrint($id){
        try {
            $student = Student::where('id_card_print',0)->findOrFail($id);
           
            // Image URLs
            $photoUrl = "https://api.darululoom-islamia.org/images/student_photo/" . $student->s_photo;
            $qrCode = "https://www.darululoom-islamia.org/students/" . $student->reg_no;
            $backgroundUrl = "https://api.darululoom-islamia.org/images/card2.png";
    
            // Load PDF view
            // return view('card-print' ,['student' => $student, 'photoUrl' => $photoUrl,'qrCode' =>$qrCode,'backgroundUrl'=>$backgroundUrl]);

              // Register the custom font with DomPDF
            $fontPath = storage_path('fonts/akrobat-regular.ttf'); // Path to the Akrobat font
            $fontFamily = 'Akrobat'; // The font family name

            // Pdf::getDomPDF()->getOptions()->set('font_dir', storage_path('font/Akrobat-SemiBold.otf'));
            // Pdf::getDomPDF()->getOptions()->set('font_cache', storage_path('font/Akrobat-SemiBold.otf'));
            // Pdf::getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);

            $pdf = Pdf::loadView('card-print', compact('student', 'photoUrl', 'qrCode', 'backgroundUrl'));
                    //   ->setPaper([0, 0,  261, 171], 'portrait'); // Custom size in points (3.625in × 2.375in)

    
            return $pdf->stream('student-card.pdf'); 

        //  $student  = Student::find($id);
        //   $photoUrl = "https://api.darululoom-islamia.org/images/student_photo/" . $student->s_photo;
        //   $qrCode = "https://www.darululoom-islamia.org/students/" .$student->reg_no;

        //     // return view('card-print' ,['student' => $student, 'photoUrl' => $photoUrl,'qrCode' =>$qrCode,'backgroundUrl'=>$backgroundUrl]);
           
        //     $pdf = PDF::loadView('card-print',['student' => $student, 'photoUrl' => $photoUrl,'qrCode' =>$qrCode,'backgroundUrl'=>$backgroundUrl])->setPaper([0, 0, 248, 165], 'portrait');
        //     return $pdf->stream('card-print.pdf');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cardPrintStatus($id)
    {
        $student =  Student::find($id);
        if ($student) {
            $student->id_card_print =  1;
            $student->save();
            return response()->json(['message' => 'Id Card Print Successfully'], 201);
        }
    }


    public function addAttendanceCard(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'attendance_id' => 'required',
            'curd_nember' => 'required',          

        ]);
        return $request->id;

    }



}
