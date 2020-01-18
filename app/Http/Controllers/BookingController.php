<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function booking()
    {
    	return view('pages.upcoming_services.search');
    }
}
