<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('buyer_item_code')->nullable()->unique();
            $table->boolean('buyer_status')->nullable();
            $table->string('buyer_pro_weight')->nullable();
            $table->string('buyer_category');
            $table->string('buyer_sale_price');
            $table->string('buyer_website');
            $table->string('buyer_pro_title');
            $table->string('buyer_pro_description');
            $table->string('buyer_location');
            $table->string('buyer_featured_image')->nullable();
            $table->string('buyer_commission_percentage')->nullable();
            $table->string('buyer_hidden_info')->nullable();
            $table->string('buyer_hidden_price')->nullable();
            $table->string('buyer_hidden_description')->nullable();
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
        Schema::dropIfExists('buyers');
    }
}
