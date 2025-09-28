<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPermitTokenUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        $method = $request->method();
        $nameRoute = $route?->getName();
        $user = $request->user();
        if($user->tokenCan($nameRoute) || $user->tokenCan('*')){
            return $next($request);
        }
        abort(403,'Não autorizado',['content-type'=>'application/json']);
    }
}
