<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMenuOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_options', function (Blueprint $table) {
            //
            $rows[] = [ 
                'id' => 56,
                'name' => 'Dispute Manager',
                'link' => '/dispute',
                'show_order' => 15,
                'ref' => 'profile_drop_down',
            ];
            DB::table('menu_options')->insert(
                $rows
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_options', function (Blueprint $table) {
            //
        });
    }
}
