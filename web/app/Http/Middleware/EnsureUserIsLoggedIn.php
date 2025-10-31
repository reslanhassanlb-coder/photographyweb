<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsLoggedIn
{
    public function handle(Request $request, Closure $next)
    {

        // AUTHENTICATION CHECK
        if (!session()->has('user_email')) {
            logger()->warning('Access denied. Redirecting to login.');
            return redirect()->route('login'); // Redirect to login if not logged in
        }

        logger()->info('Access granted to /offers.');
        return $next($request);
    }
}
