<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role !== $role) {
            dd(Auth::user()->role . ' ' . $role);
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
