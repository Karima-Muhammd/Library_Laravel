<?php

namespace App\Http\Middleware\Api;

use App\Traits\GeneralTrait;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use GeneralTrait;
    public function handle($request, Closure $next)
    {
        if($request->has('api_token') && $request->api_token!==null)
        {
            //select token from users where api_token
            $user=User::where('api_token','=',$request->api_token )->where('role','=','admin')->first();
            if($user!==null)
                return $next($request);
            else
                return $this->returnError('No Authenticated');
        }

        return $this->returnError('Api Token Cant be Empty - No Authenticated ');
    }
}
