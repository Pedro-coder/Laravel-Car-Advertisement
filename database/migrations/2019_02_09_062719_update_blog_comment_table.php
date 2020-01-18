<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBlogCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_post', function (Blueprint $table) {
            
            $table->dropColumn('person_name');
            $table->dropColumn('person_email');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_post', function (Blueprint $table) {
            $table->string('person_name')->nullable();
            $table->string('person_email')->nullable();
        });
    }
}
