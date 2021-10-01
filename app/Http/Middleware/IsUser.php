<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class IsUser
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
        $guard = 'user';

        if (! (Auth::guard($guard)->user() && ! Auth::guard($guard)->user()->isAdmin())) {
            return Response::make('Unauthorized.', 401);
        }

        return $next($request);
    }
}
