<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
    //
    protected $guarded = [];

    public function credit($data2)
    {
        $response = Balance::create($data2);
    }
    public function transfer($data2)
    {
        $id = $data2['id'];
        unset($data2['id']);
        $data3['user_id']     = $id;
        $data3['description'] = $data2['description'];
        $data3['details']     = $data2['details'];
        $data3['type']        = "cr";
        $data3['datwise']     = date("Y-m-d");
        $data3['amount']      = $data2['withdraw'];
        $data3['transaction_id']      = $data2['transaction_id'];
        $response = Balance::create($data2);
        //$response = Balance::create($data3);

    }
    public function isUserHasPermission($userId)
    {
        return DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',9)->get();
    }
}
