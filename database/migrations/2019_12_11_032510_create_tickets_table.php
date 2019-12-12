<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('ticket_id');
            $table->string('ticket_name');
            $table->double('ticket_cost');
            $table->double('special_validity');
            $table->integer('max_tickets') ->nullable();
            $table->dateTime('tickets_sell_by_date') ->nulllable();
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
        Schema::dropIfExists('tickets');
    }
}
