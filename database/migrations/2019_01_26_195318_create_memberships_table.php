<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->date('join_date')->nullable();
            $table->string('membership_type')->nullable();
            $table->string('membership_category')->nullable();
            $table->string('admin_code')->nullable();
            $table->string('status')->nullable();
            $table->string('cell_num')->nullable();
            $table->string('email')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('yearly_income')->nullable();
            $table->string('profession_name')->nullable();
            $table->string('profession_type')->nullable();
            $table->string('share_rate')->nullable();
            $table->string('blah')->nullable();
            $table->string('account_detail')->nullable();
            $table->string('nationality_2')->nullable();
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
        Schema::dropIfExists('memberships');
    }
}
