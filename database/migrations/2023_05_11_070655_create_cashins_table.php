<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashins', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('batch_id');
            $table->integer('student_id');
            $table->integer('purpose_id');
            $table->string('pay_by');
            $table->integer('amount');
            $table->integer('receipt_no');
            $table->date('date');
            $table->text('note')->nullable();
            $table->integer('created_by');
            $table->integer('ip_address');
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
        Schema::dropIfExists('cashins');
    }
}
