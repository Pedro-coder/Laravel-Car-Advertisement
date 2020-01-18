<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dispute extends Model
{
    //
    protected $guarded = [];

    public function isUserHasPermission($userId)
    {
        return DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',56)->get();
    }
    // 
}
