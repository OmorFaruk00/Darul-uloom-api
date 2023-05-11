<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('email')->unique();
            $table->string('password', 200);             
            $table->integer('designation_id');
            $table->integer('department_id');            
            $table->integer('personal_phone_no', 15);
            $table->integer('alternative_phone_no', 15)->nullable();           
            $table->integer('parent_phone_no', 15)->nullable();
            $table->integer('home_phone_no', 15)->nullable();            
            $table->enum('jobtype', ['Part Time', 'Full Time']);
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_join')->nullable();            
            $table->integer('nid_no', 20)->nullable();            
            $table->string('profile_photo', 100)->nullable();            
            $table->integer('status');           
            $table->string('role')->default('Admin');           
            $table->text('permissions')->nullable();
            $table->integer('supervised_by');           
            $table->string('weekly_working_hours', 7)->nullable();           
            $table->integer('created_by');
            $table->string('merit', 20)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('employees');
    }
}
