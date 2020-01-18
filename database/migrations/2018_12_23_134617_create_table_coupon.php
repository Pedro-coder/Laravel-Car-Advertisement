<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon_code');
            $table->string('number_available');
            $table->date('start_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('coupon_type');
            $table->string('coupon_amount')->default(0);
            $table->string('criteria');
            $table->string('used')->nullable();
            $table->text('shipping_method')->nullable();
            $table->text('selected_product')->nullable();
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
        Schema::dropIfExists('coupon');
    }
}
