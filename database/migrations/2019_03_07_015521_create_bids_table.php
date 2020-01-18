<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
          
            $table->integer('user_id');
            $table->integer('occupation');
            $table->string('phone');
            $table->string('address');
            $table->string('description');
            $table->integer('auto_order')->nullable();
            $table->double('current_bid');
            $table->double('referral')->nullable();
            $table->string('country');
            $table->string('delivery_date');
    
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
        Schema::dropIfExists('bids');
    }
}
