<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_bids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->enum('bid_type',['buy','sell'])->nullable();
            $table->string('reference_id')->comment('buyer table id or seller table id');
            $table->double('amount');
            $table->enum('status',['pending','accept','reject'])->default('pending');
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
        Schema::dropIfExists('post_bids');
    }
}
