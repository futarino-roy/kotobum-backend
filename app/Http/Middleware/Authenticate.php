<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return null;
        // return $request->expectsJson() ? null : route('login');
    }

    protected function authenticate($request, array $guards)
    {
        if (in_array('sanctum', $guards)) {
            return Auth::guard('admin')->check() || Auth::guard('web')->check();
        }

        $this->unauthenticated($request, $guards);
    }
}
