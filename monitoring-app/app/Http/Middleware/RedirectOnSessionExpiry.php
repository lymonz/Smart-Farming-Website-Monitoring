<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectOnSessionExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (! $request->session()->has('lastActivityTime')) {
            $request->session()->put('lastActivityTime', time());
        }

        $lastActivityTime = $request->session()->get('lastActivityTime');
        $sessionLifetime = config('session.lifetime') * 60; // Convert minutes to seconds

        if (time() - $lastActivityTime > $sessionLifetime) {
            return redirect()->route('logout-due-to-inactivity');
        }

        return $next($request);
    }
}
