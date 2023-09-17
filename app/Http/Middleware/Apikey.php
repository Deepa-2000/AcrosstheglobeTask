<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Apikey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('api_key')== "helloatg" ) {
            return $next($request);
        }else {
            $data=[
                'status'=> 0,
                'message'=> "Invalid API key",
            ];
            return response()->json($data);
        }
    }
}
