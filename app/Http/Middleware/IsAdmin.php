<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user(); // Get the currently authenticated user
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // If the user is not an admin or not logged in, redirect user to login page:
            return redirect()->route('login')->with('info', 'Login is required');
    }
}
