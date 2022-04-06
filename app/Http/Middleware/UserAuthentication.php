<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * UserAuthentication
 * @package App\Http\Middleware\
 * @since 2022.04.06
 * @version 1.0
 */
class UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $iUserId = session()->get('user_id');
        if (empty($iUserId) === true || $iUserId < 1) {
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}
