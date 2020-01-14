<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('organizer'))
        {
            Schema::create('organizer', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('organizer_email', 255) -> unique();
                $table->string('organizer_password', 255);
                $table->string('organizer_name', 255);
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
        Schema::dropIfExists('organizer');
    }
}
