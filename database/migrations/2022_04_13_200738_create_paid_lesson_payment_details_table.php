<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidLessonPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_lesson_payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('payer_name');
            $table->string('payer_surname');
            $table->string('email_address');
            $table->string('currency_code');
            $table->decimal('amount');
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
        Schema::dropIfExists('paid_lesson_payment_details');
    }
}
