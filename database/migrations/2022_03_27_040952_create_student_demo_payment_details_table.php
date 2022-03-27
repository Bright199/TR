<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDemoPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_demo_payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('payer_name');
            $table->string('payer_surname');
            $table->string('email_address');
            $table->string('currency_code');
            $table->integer('amount');
            $table->integer('teacher_id');
            $table->integer('student_id');
            $table->string('payer_id');
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
        Schema::dropIfExists('student_demo_payment_details');
    }
}
