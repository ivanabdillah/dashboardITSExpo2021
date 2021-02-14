<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
        $user = $request->user()->load('role');
        if (!($user['role']['id'] == 2) or !($user['role']['name'] === 'admin')) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
