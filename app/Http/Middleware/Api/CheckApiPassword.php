<?php

namespace App\Http\Middleware\Api;

use Closure;

class CheckApiPassword
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
        if($request->api_password !==env('API_PASSWORD'))
        {
            return response(['un Authenticated']);
        }
        else
            return $next($request);
    }
}
