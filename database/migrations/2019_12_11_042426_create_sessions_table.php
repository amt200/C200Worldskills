<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sessions'))
        {
            Schema::create('sessions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('event_id')->unsigned();
                $table->integer('room_id')->unsigned();
                $table->integer('session_type_id')->unsigned();
                $table->dateTime('start_time');
                $table->dateTime('end_time');
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
        Schema::dropIfExists('sessions');
    }
}
