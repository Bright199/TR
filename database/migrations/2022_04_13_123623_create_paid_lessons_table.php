<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('student_id');
            $table->decimal('teacher_hourly_pay');
            $table->integer('student_booked_hours');
            $table->decimal('paid_amount');
            $table->time('time_slot');
            $table->dateTime('date');
            $table->boolean('booked');
            $table->boolean('lessons_completed');
            $table->integer('remaining_lesson_hours');
            $table->decimal('remaining_amount');
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
        Schema::dropIfExists('paid_lessons');
    }
}
