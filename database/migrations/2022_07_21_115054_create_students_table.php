<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('batch_id');
            $table->integer('shift_id');
            $table->integer('group_id');
            $table->integer('adm_frm_sl');
            $table->integer('roll_no');
            $table->string('reg_no');
            $table->string('student_name_bangla');
            $table->string('student_name_english');
            $table->string('blood_group');
            $table->string('gender');
            $table->string('dob')->nullable();
            $table->integer('std_birth_no');
            $table->string('permanent_add');
            $table->string('mailing_add');
            $table->string('s_photo')->nullable();
            $table->string('birth_certificate_photo')->nullable();
            $table->string('f_name');
            $table->integer('f_cellno1');
            $table->integer('f_cellno2')->nullable();
            $table->string('f_occu')->nullable();
            $table->integer('f_nid_no');
            $table->string('f_photo')->nullable();
            $table->string('m_name');
            $table->integer('m_cellno1');
            $table->integer('m_cellno2')->nullable();
            $table->string('m_occu')->nullable();
            $table->integer('m_nid_no');
            $table->string('g_name');
            $table->integer('g_cellno1');
            $table->integer('g_cellno2')->nullable();
            $table->string('g_occu')->nullable();
            $table->integer('g_nid_no');
            $table->string('guardian_add');
            $table->string('g_photo')->nullable();
            $table->string('previous_institute');
            $table->string('last_program_of_study');
            $table->string('name_of_examiner');
            $table->string('remark_of_examiner');
            $table->string('institute_add');           
            $table->integer('entry_by')->nullable();
            $table->integer('status')->default(1);
            $table->string('entry_date')->nullable();            
            $table->string('entry_ip_address')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
