<?php

use Illuminate\Database\Seeder;

class site_info extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /* $rows = [];
        $rows[] = [
            'id' => 9,
            'attr_name' => 'form_opacity',
            'attr_value' => '1',
        ];

        DB::table('site_info')->insert(
            $rows
        ); */
        // DB::table('site_info')->insert(
        //     $rows
        // );

        DB::table('site_info')->where('attr_name','form_opacity')->update(['attr_value' => '1']);
    }
}
