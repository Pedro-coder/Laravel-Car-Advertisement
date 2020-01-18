<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateEscrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = 'escrow@hi5.com';
        $user->name = 'escrow';
        $user->location = null;
        $user->phone_no = null;
        $user->paypal_email = null;
        $user->password = Hash::make('123456');
        $user->status = 1;
        $user->email_verified_at = Carbon::now();
        $user->save();

        $user2 = new User;
        $user2->email = 'hi5@hi5.com';
        $user2->name = 'hi5';
        $user2->location = null;
        $user2->phone_no = null;
        $user2->paypal_email = null;
        $user2->password = Hash::make('123456');
        $user2->status = 1;
        $user2->email_verified_at = Carbon::now();
        $user2->save();

        $user3 = new User;
        $user3->email = 'system@hi5.com';
        $user3->name = 'system';
        $user3->location = null;
        $user3->phone_no = null;
        $user3->paypal_email = null;
        $user3->password = Hash::make('123456');
        $user3->status = 1;
        $user3->email_verified_at = Carbon::now();
        $user3->save();
    }
}
