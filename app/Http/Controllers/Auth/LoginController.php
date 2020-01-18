<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function redirectTo()
    {
        $geo = getLocationInfoWithIpAddress();
        $user = \App\User::where('id','=',Auth::user()->id)->first();
        $user->alt = $geo->latitude;
        $user->lng = $geo->longitude;
        $user->location = $geo->time_zone;
        $user->save();
        return '/home';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $id=auth()->user()->id;
        $user = User::find($id);
        $user->onlineStatus = 0;
        $user->save();
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        $this->performLogout($request);
        return redirect()->route('home');
    }
}
