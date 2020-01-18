<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventEndDateToEventModals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_modals', function (Blueprint $table) {
            //
            $table->string('event_end_date');
            $table->string('goingstatus')->nullable()
                                       ->comment = 'going or not going';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_modals', function (Blueprint $table) {
            //
            $table->string('event_end_date');
            $table->string('goingstatus');

        });
    }
}
