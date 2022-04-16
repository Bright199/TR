<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('student_id');
            $table->string('teacher_name');
            $table->string('teacher_email');
            $table->string('student_name');
            $table->string('student_email');
            $table->boolean('is_booked_by_student')->default(0);
            $table->string('teacher_image')->nullable();
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
        Schema::dropIfExists('student_contacts');
    }
}
