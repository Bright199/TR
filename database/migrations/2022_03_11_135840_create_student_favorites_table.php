<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_favorites', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('teacher_email')->nullable();
            $table->string('teacher_image')->nullable();
            $table->integer('student_id')->nullable();
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
        Schema::dropIfExists('student_favorites');
    }
}
