<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ValidateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()->IsAdmin)
        return abort(500, 'Access denied');

        return $next($request);
    }
}
