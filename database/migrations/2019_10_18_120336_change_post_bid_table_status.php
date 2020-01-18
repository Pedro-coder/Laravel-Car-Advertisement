<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePostBidTableStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_bids', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('post_bids', function (Blueprint $table) {
            $table->enum('status',['pending','ordered','in_process','delivered','paid','closed','got_dispute','send_dispute','got_dispute_accept','send_dispute_accept','got_dispute_decline','send_dispute_decline'])->default('pending');
            $table->string('due_date')->nullable();
            $table->string('reference_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_bids', function (Blueprint $table) {
            $table->dropColumn('due_date');
            $table->dropColumn('reference_email');
        });
    }
}
