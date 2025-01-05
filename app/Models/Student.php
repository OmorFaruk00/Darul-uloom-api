<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function education()
    {
        return $this->hasOne('App\Models\Education', 'student_reg_code', 'reg_code');
    }
    public function department()
    {
        return $this->hasMany('App\Models\Section','id','department_id');
    }
    public function dept()
    {
        return $this->hasOne('App\Models\Section','id','department_id')->select('id','department_name');
    }
    public function batch()
    {
        return $this->hasOne('App\Models\Batch', 'id', 'batch_id')->select('id','batch_name');
    }
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'entry_by')->select('id','name');
    }
}
