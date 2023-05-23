<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class AllowIpAddressMiddleware
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
        $allowedIps = explode("|", env("ALLOW_IP"));

        if (in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }
        else{
            return response()->json(['message' => "You are not allowed to access this site."]);
        }       
    }     
}