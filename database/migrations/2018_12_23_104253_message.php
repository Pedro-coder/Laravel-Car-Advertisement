<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Message extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('RoomId')->reference('id')->on('chatrooms');
            $table->string('sender')->reference('id')->on('users');
            $table->string('receiver')->reference('id')->on('users');

            $table->text('message');
            $table->integer('readWriteStatus');
            $table->integer('activationStatus');
            $table->string('UTC');
            $table->string('selftime');
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
        Schema::dropIfExists('messages');
    }
}
