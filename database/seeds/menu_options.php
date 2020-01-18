<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class menu_options extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$rows = [];
        $rows[] = [
            'name' => 'Taxi admin',
            'link' => '/usertaxi',
            'show_order' => 16,
            'ref' => 'profile_drop_down',
        ];
        DB::table('menu_options')->insert(
            $rows
        );
         $rows = [];
        $rows[] = [
            'id' => 1,
            'name' => 'User Access',
            'link' => '/UserAccess',
            'show_order' => 1,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 2,
            'name' => 'HelpDesk',
            'link' => '/admin',
            'show_order' => 3,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 3,
            'name' => 'Category Setup',
            'link' => '/CategorySetup',
            'show_order' => 4,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 4,
            'name' => 'Admin Panel',
            'link' => '/admin',
            'show_order' => 5,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 5,
            'name' => 'Edit Product Listing',
            'link' => '/admin',
            'show_order' => 6,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 6,
            'name' => 'Refresh Order',
            'link' => '/admin',
            'show_order' => 7,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 7,
            'name' => 'Query Screen',
            'link' => '/QueryScreen',
            'show_order' => 2,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 8,
            'name' => 'Brand Update',
            'link' => '/brandupdate',
            'show_order' => 8,
            'ref' => 'profile_drop_down',
        ];
        $rows[] = [
            'id' => 9,
            'name' => 'Accountant',
            'link' => '/admin',
            'show_order' => 9,
            'ref' => 'profile_drop_down',
        ];

        DB::table('menu_options')->insert(
            $rows
        ); */

       /*  $rows = [];
        $rows[] = [
            'id' => 1,
            'attr_name' => 'logo_pic',
            'attr_value' => 'favicon.ico',
        ];
        $rows[] = [
            'id' => 2,
            'attr_name' => 'test_next_to_logo',
            'attr_value' => 'DropShip',
        ];
        $rows[] = [
            'id' => 3,
            'attr_name' => 'header_left_pic',
            'attr_value' => '1542324537.jpg',
        ];
        $rows[] = [
            'id' => 4,
            'attr_name' => 'site_name',
            'attr_value' => "Boo! it's almost Halloween! up",
        ];
        $rows[] = [
            'id' => 5,
            'attr_name' => 'site_slogan',
            'attr_value' => 'Find ideas for your best-ever costume, tricks and treat up',
        ];
        $rows[] = [
            'id' => 6,
            'attr_name' => 'header_right_pic',
            'attr_value' => '1542404593.png',
        ];
        $rows[] = [
            'id' => 7,
            'attr_name' => 'above_footer_pic',
            'attr_value' => '1542403914.jpg',
        ];
        $rows[] = [
            'id' => 8,
            'attr_name' => 'footer_pic',
            'attr_value' => '1542404593.png',
        ];

        DB::table('site_info')->insert(
            $rows
        );

        $rows = [];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '1',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '2',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '3',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '4',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '5',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '6',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '7',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '8',
        ];
        $rows[] = [
            'user_id' => '41',
            'menu_options_id' => '9',
        ];

        DB::table('user_menu')->insert(
            $rows
        );

        $rows = [];
        $rows[] = [
            'id' => '41',
            'name' => 'admin',
            'email' => 'admin@hi5.com',
            'avatar' => 'default.png',
            'IsAdmin' => '1',
            'password' => '$2y$10$/vHsjq.DJo7iKHi3qH49JuTBHCbauGjBcIb4R5JLUvA4A4ZuyhMba',
            'remember_token' => '3dk86G4TqULs1ePGGNAAeFyZ3bQTfMdXlh7CW7bz3i7QNaQiGOQ6GsCQGPY0',
            'created_at' => '2018-11-18 14:26:46',
            'updated_at' => '2018-11-18 14:26:46',
            'status' => 1
        ];

        DB::table('users')->insert(
            $rows
        ); */
        /*$rows = [];
        DB::table('menu_options')
            ->where('id', 9)
            ->update(['link' => '/accountant']);*/
    }

}
