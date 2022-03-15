<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('our_tearcher')->default(0);
            $table->boolean('online')->default(0);
            $table->string('teacher_image')->nullable();
            $table->text('description')->nullable();
            $table->string('hourly_pay')->nullable();
            $table->string('currency')->nullable();
            $table->string('first_language')->nullable();
            $table->string('first_language_proficiency')->nullable();
            $table->string('second_language')->nullable();
            $table->string('second_language_proficiency')->nullable();
            $table->string('third_language')->nullable();
            $table->string('third_language_proficiency')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('teachers');
    }
}
