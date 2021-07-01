<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\traits\generalTrait;

class checkAuth
{
    use generalTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('api')->check()){
            return $next($request);
        }else{
            return $this->returnErrorMessage(Null,"Unauthorized User",401);
        }
    }
}
