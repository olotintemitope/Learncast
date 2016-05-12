<?php

namespace LearnCast\Http\Middleware;

use Auth;
use Closure;

class AuthVideoCategory
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id === 1) {
            abort(401);
        }

        return $next($request);
    }
}
