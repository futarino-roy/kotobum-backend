<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        // Check if the user is authenticated with the 'admin' guard
        if (!Auth::guard('admin')->check()) {
            // Redirect to the login form if not authenticated
            return redirect()->route('admin.login_form');
        }

        // Proceed with the request if authenticated
        return $next($request);
    }
}
