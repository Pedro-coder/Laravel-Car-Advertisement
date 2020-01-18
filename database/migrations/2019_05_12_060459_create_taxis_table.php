<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('vahical_name');
            $table->string('referral');
            $table->string('car_image');
            $table->string('license_image');
            $table->string('registration_images');
            $table->string('security_number');
            $table->string('rate_per_our');
            $table->string('location');
            $table->string('condition_note');
            $table->tinyInteger('is_booked')->default(0);
            $table->tinyInteger('status')->default(2);
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
        Schema::dropIfExists('taxis');
    }
}
