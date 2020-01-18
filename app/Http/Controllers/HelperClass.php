<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class HelperClass extends Controller
{
	//Car status
	public static $DELETE = 0;
    public static $APPROVE = 1;
    public static $PENDING = 2;
    public static $REJECTED = 3;

    //Car booking status
    public static $BOOKED = 1;
    public static $NOTBOOKED = 0;

    public static function getSettings(){
        $settings = Setting::first();
        return $settings;
    }
}
