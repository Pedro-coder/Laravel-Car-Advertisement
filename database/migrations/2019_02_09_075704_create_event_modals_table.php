<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventModalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('event_modals');
        Schema::create('event_modals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('event_date');
            $table->string('event_start_time');
            $table->string('event_end_time');
            $table->string('event_ticket_price');
            $table->string('event_details');
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
        Schema::dropIfExists('event_modals');
    }
}
