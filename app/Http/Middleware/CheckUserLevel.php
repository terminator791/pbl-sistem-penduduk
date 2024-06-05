<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$levels
     * @return mixed
     */
    public function handle($request, Closure $next, ...$levels)
    {
        if (Auth::check() && in_array(Auth::user()->level, $levels)) {
            return $next($request);
        }
        
        return redirect()->back();
        // return response()->view('errors.error-403', [], 403);
    }
}
