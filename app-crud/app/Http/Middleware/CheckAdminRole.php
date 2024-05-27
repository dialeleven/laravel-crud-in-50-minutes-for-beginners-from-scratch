<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        #dd('test');
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            if ($user->role_id !== null && in_array($user->role_id, [1, 2])) {
                return $next($request);
            }
        }

        // If the user is not authenticated or does not have the required role, redirect to a 403 page
        return redirect()->route('product.index')->withErrors('You do not have access to the requested page.');
    // return $next($request);
    }
}

