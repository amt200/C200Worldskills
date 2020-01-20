<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('register'))
        {
            Schema::create('register', function (Blueprint $table) {
                $table->bigIncrements('registration_id');
                $table->integer('attendee_id')->unsigned();
                $table->integer('event_id')->unsigned();
                $table->integer('ticket_id');
                $table->integer('session_id')->nullable();
                $table->string('token');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register');
    }
}
