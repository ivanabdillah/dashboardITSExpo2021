<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPeserta
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
        if (!($user['role']['id'] == 1) or !($user['role']['name'] === 'peserta')) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
