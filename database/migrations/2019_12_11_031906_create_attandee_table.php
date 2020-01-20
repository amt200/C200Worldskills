<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttandeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('attendees'))
        {
            Schema::create('attendees', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('firstName');
                $table->string('lastName');
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
        Schema::dropIfExists('attandee');
    }
}
