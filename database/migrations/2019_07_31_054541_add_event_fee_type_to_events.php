<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventFeeTypeToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->string('event_fee_type')->default('Free');                           
            $table->string('event_fee')->nullable()
                                       ->comment = 'If event not free';
            $table->string('event_referral_commission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->string('event_fee_type');
            $table->string('event_fee');
            $table->string('event_referral_commission');
        });
    }
}
