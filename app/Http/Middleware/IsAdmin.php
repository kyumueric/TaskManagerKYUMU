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
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated AND is an admin
            if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Redirect non-admin users with an error message
        return redirect('/dashboard')->with('error', 'You do not have admin access.');
    }
}