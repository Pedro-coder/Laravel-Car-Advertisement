<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
class ValididateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {


        if(Auth::user()->status==2 && !Auth::user()->IsAdmin)
            return abort(500, 'Profile under review');
        if(Auth::user()->status==3 && !Auth::user()->IsAdmin)
            return abort(500, 'Block for Dues');
        if(Auth::user()->status==4 && !Auth::user()->IsAdmin)
            return abort(500, 'Block for Dispute');


        return $next($request);
    }
}
