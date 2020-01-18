<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuOptionAdvertisement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $rows[] = [
        'id' => 10,
        'name' => 'Advertisement',
        'link' => '/advertisement',
        'show_order' => 0,
        'ref' => 'profile_drop_down',
    ];

        DB::table('menu_options')->insert(
            $rows
        );
    }
}
