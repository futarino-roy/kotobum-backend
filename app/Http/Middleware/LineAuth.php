<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class LineAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!app()->isProduction()){
            return $next($request);
        };

        // 不正アクセスのブロック
        if(!Str::containsAll($request->header('user-agent'), ['LIFF', 'Line'])){
            return response()->json('Ok');
        }

        return $next($request);
    }
}
