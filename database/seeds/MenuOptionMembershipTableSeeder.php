<?php

use Illuminate\Database\Seeder;

class MenuOptionMembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
}
