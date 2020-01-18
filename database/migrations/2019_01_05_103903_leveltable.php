<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Leveltable extends Migration
{
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
           $table->integer('userleveler');
           $table->integer('userbeenleveled');
           $table->string('value');
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
        Schema::dropIfExists('levels');
    }
}
