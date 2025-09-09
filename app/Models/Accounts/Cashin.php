<?php

namespace App\Models\Accounts;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Student;

// use App\Models\Section;
// use App\Models\Batch;
// use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashin extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function purpose()
    {
        return $this->hasOne(PaymentPurpose::class, 'id', 'purpose_id')->select('id','name');
    }
    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'department_id')->select('id','department_name');
    }
    public function batch()
    {
        return $this->hasOne(Batch::class, 'id', 'batch_id')->select('id','batch_name');
    }
    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id')->select('id','student_name_english','roll_no','reg_no');
    }
}
