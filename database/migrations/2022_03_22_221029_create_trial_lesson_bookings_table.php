<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialLessonBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_lesson_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->boolean('booked')->default(0);
            $table->boolean('lesson_completed')->default(0);
            $table->integer('student_id');
            $table->dateTime('teacher_date');
            $table->dateTime('student_date');
            $table->string('teacher_timezone');
            $table->string('student_timezone');
            $table->time('teacher_timeslot');
            $table->time('student_timeslot');
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
        Schema::dropIfExists('trial_lesson_bookings');
    }
}
