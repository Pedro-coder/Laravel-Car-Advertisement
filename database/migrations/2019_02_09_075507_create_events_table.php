<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('events');        
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('event_checked')->nullable();
            $table->string('schedule_checked')->nullable();
            $table->string('event_featured_image')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_start_time')->nullable();
             $table->string('event_end_time')->nullable();
            $table->string('event_ticket_price')->nullable();
             $table->string('event_details')->nullable();
            $table->string('event_title')->nullable();
            $table->string('interested_in_event')->nullable();
             $table->string('going_in_event')->nullable();
            $table->string('event_city')->nullable();
            $table->string('event_country')->nullable();
            $table->string('event_phone')->nullable();
            $table->string('event_address')->nullable();
            $table->string('event_is_online')->nullable();
             $table->string('no_need_approval')->nullable();
           $table->string('need_approval')->nullable();
           $table->string('event_host_image')->nullable();
             $table->string('event_host_name')->nullable();
            $table->string('event_type')->nullable();
             $table->string('event_description')->nullable();
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
        //Schema::dropIfExists('events');
    }
}
