<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function relDesignation()
    {
        return $this->belongsTo('App\Models\Designation', 'designation_id', 'id');
    }
    public function relDepartment()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
    public function relSocial()
    {
        return $this->hasMany('App\Models\Social',  'employee_id','id');
    }
    public function relQualification()
    {
        return $this->hasMany('App\Models\Qualification',  'employee_id','id');
    }
    public function relTraining()
    {
        return $this->hasMany('App\Models\Training',  'employee_id','id');
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'array',
    ];
}
