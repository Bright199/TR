<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_ads', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('title');
            $table->string('description');
            $table->string('language_category');
            $table->string('minimum_budget');
            $table->string('maximum_budget');
            $table->string('currency');
            $table->string('student_gender');
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
        Schema::dropIfExists('student_ads');
    }
}
