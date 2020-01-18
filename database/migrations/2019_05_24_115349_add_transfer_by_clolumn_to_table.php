<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransferByClolumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->integer('posted_by')->nullable();
            $table->integer('transaction_by')->nullable();
            $table->integer('is_freeze_or_refund')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->integer('posted_by')->nullable();
            $table->integer('transaction_by')->nullable();
            $table->integer('is_freeze_or_refund')->nullable();
        });
    }
}
