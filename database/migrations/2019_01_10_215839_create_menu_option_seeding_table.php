<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOptionSeedingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rows[] = [
            'id' => 14,
            'name' => 'Membership',
            'link' => '/membership',
            'show_order' => 0,
            'ref' => 'profile_drop_down',
        ];
        DB::table('menu_options')->insert(
            $rows
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_options');
    }
}
