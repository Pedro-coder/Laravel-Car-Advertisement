<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chatroom extends Migration
{
    public function up()
    {
        Schema::create('chatrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('chatRoomId')->unique();
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
        Schema::dropIfExists('chatrooms');
    }
}
