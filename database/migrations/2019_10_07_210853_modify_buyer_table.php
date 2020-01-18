<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBuyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            //
            $table->tinyInteger('buyer_category_option');
            $table->string('longitude');
            $table->string('latitude');
            $table->tinyInteger('service_option');
            $table->string('hour');
            $table->string('rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('buyer_category_option');
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
            $table->dropColumn('hour');
            $table->dropColumn('rate');
            $table->dropColumn('service_option');
        });
    }
}
