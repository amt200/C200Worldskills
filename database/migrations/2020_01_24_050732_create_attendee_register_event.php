<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeRegisterEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_register_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attendee_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->integer('sessions_id')->unsigned();
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
        Schema::dropIfExists('attendee_register_event');
    }
}
