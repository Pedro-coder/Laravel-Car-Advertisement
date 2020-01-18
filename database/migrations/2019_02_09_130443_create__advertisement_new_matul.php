<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementNewMatul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('advertisements');
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('adds_name');
            $table->string('adds_type');
            $table->string('image')->nullable();
            // $table->string('image_link_embeded_or_referrel_code');
            $table->string('position');
            $table->string('style')->nullable();
            $table->string('ads_post_on');
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamps();
            $table->string('image_link')->nullable();
            $table->string('embed_code')->nullable();
            $table->string('referral_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
