<?php

use Illuminate\Database\Seeder;
//use \database\seeds\menu_options;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('menu_options')->where('show_order',12)->update(['link' => '/helpchatdashboard']);
        
         DB::table('users')->insert([
         'id'=>55,
             'name' => 'Help Desk',
             'email' => 'helpdesk@hi5.com',
             'password' => bcrypt('123456'),
             'avatar' => 'default.png',
             'IsAdmin' => 1,
             'status' => 1
         ]);

       // $data = DB::table('users_bkups')->get()->toArray();

       /* foreach($data as $key=>$user){
           DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'IsAdmin' => $user->IsAdmin,
                'location' => $user->location,
                'phone_no' => $user->phone_no,
                'paypal_email' => $user->paypal_email,
                'password' => $user->password,
                'email_verified_at' => $user->email_verified_at,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'status' => $user->status,
                'photo_id' => $user->photo_id,
                'webcam_image' => $user->webcam_image,
                'onlineStatus' => $user->onlineStatus,
                'utc' => $user->utc,
                'verify_tokekn' => $user->verify_tokekn,
                'verify_status' => $user->verify_status,
                'cover_img' => $user->cover_img,
                'about' => $user->about,
                'alt' => $user->alt,
                'lng' => $user->lng
            ]);
        }*/
        
        
        

        
        $this->call([
            menu_options::class
        ]);
        /*$this->call([
            site_info::class
        ]);
        $this->call([
            MenuOptionAdvertisement::class
        ]);*/

        /*$this->call([
            user_menu::class
        ]);
        $this->call([
            users::class
        ]);
        $this->call([
            site_info::class
        ]);*/
    }
}
