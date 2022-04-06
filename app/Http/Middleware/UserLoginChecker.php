<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * UserLoginChecker
 * @package App\Http\Middleware\
 * @since 2022.04.06
 * @version 1.0
 */
class UserLoginChecker
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
        if (empty($iUserId) === false || $iUserId > 0) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
