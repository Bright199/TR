<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('week_day')->nullable();
            $table->string('teacher_timezone')->nullable();
            $table->time('slot1')->nullable();
            $table->time('slot2')->nullable();
            $table->time('slot3')->nullable();
            $table->time('slot4')->nullable();
            $table->time('slot5')->nullable();
            $table->time('slot6')->nullable();
            $table->time('slot7')->nullable();
            $table->time('slot8')->nullable();
            $table->time('slot9')->nullable();
            $table->time('slot10')->nullable();
            $table->time('slot11')->nullable();
            $table->time('slot12')->nullable();
            $table->time('slot13')->nullable();
            $table->time('slot14')->nullable();
            $table->time('slot15')->nullable();
            $table->time('slot16')->nullable();
            $table->time('slot17')->nullable();
            $table->time('slot18')->nullable();
            $table->time('slot19')->nullable();
            $table->time('slot20')->nullable();
            $table->time('slot21')->nullable();
            $table->time('slot22')->nullable();
            $table->time('slot23')->nullable();
            $table->time('slot24')->nullable();
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
        Schema::dropIfExists('time_slots');
    }
}
