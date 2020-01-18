<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReactionsToBlogPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('total_likes')->default(0);
            $table->string('total_dislikes')->default(0);
            $table->string('total_loves')->default(0);
            $table->string('total_angry')->default(0);
            $table->string('total_sad')->default(0);
            $table->string('total_happy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('total_likes');
            $table->dropColumn('total_dislikes');
            $table->dropColumn('total_loves');
            $table->dropColumn('total_angry');
            $table->dropColumn('total_sad');
            $table->dropColumn('total_happy');
        });
    }
}
