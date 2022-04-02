<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiPassword
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
        if ($request->header('API_PASSWORD') != env('API_PASSWORD')){
            return response()->json(['message'=>'Unauthenticated.']);
        }
        return $next($request);
    }
}
