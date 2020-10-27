<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferrer
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
        if ($request->get('ref')) {
            $request->session()->put('referrer', $request->get('ref'));
        }

        return $next($request);
    }
}
