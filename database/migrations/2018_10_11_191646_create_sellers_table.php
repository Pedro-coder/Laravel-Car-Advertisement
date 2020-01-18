<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('seller_status')->nullable();
            $table->string('seller_item_code')->unique();
            $table->string('seller_pro_weight')->nullable();
            $table->string('seller_category');
            $table->string('seller_org_price');
            $table->string('seller_sale_price');
            $table->string('seller_website');
            $table->string('seller_pro_title');
            $table->longText('seller_pro_description');
            $table->string('seller_location');
            $table->string('seller_info_from');
            $table->string('seller_info_price');
            $table->longText('seller_info_description');
            $table->string('seller_featured_image')->nullable();
            $table->string('seller_commission_percentage')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
