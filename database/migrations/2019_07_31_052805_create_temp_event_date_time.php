<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempEventDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_event_date_time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temp_event_id')->default(0);
            $table->string('start_date');
            $table->string('start_hours');
            $table->string('start_minit');
            $table->string('start_type');
            $table->string('end_date');
            $table->string('end_hours');
            $table->string('end_minit');
             $table->string('end_type');
            $table->string('goingstatus');
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
        Schema::dropIfExists('temp_event_date_time');
    }
}
