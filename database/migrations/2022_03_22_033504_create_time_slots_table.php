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
            $table->time('slot25')->nullable();
            $table->time('slot26')->nullable();
            $table->time('slot27')->nullable();
            $table->time('slot28')->nullable();
            $table->time('slot29')->nullable();
            $table->time('slot30')->nullable();
            $table->time('slot31')->nullable();
            $table->time('slot32')->nullable();
            $table->time('slot33')->nullable();
            $table->time('slot34')->nullable();
            $table->time('slot35')->nullable();
            $table->time('slot36')->nullable();
            $table->time('slot37')->nullable();
            $table->time('slot38')->nullable();
            $table->time('slot39')->nullable();
            $table->time('slot40')->nullable();
            $table->time('slot41')->nullable();
            $table->time('slot42')->nullable();
            $table->time('slot43')->nullable();
            $table->time('slot44')->nullable();
            $table->time('slot45')->nullable();
            $table->time('slot46')->nullable();
            $table->time('slot47')->nullable();
            $table->time('slot48')->nullable();
            
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
