<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->level === 'admin') {
            return $next($request);
        }elseif (auth()->user()->level === 'RT'){
            return $next($request);
        }elseif (auth()->user()->level === 'RW'){
            return $next($request);
        }elseif (auth()->user()->level === 'pemilik_kos'){
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
    }
}
