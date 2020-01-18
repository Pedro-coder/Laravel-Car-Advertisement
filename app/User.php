<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Favoriteability;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'location', 'phone_no', 'paypal_email', 'password','status','about', 'verify_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function buyer(){
        return $this->hasMany(Buyer::class);
    }

    public function seller(){
        return $this->hasMany(Seller::class);
    }

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function eventModal(){

        return $this->hasMany(EventModal::class);
    }

    public function event(){

        return $this->hasMany(Event::class);
    }
    public function isUserHasTaxiPermission()
    {
        return DB::table('user_menu')->where('user_id',Auth::user()->id)->where('menu_options_id',57)->get();
    }
}
