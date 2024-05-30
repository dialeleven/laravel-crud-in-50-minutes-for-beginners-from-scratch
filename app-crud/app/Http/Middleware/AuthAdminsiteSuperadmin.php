<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthAdminsiteSuperadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        #dd(Auth::user());
        #dd(auth()->user());

        // Check if user is authenticated and has superadmin (id = 1) role
        if (!auth()->check() || auth()->user()->role->id !== 1) {
            #dd(auth()->user()->role->id);
            return redirect()->route('admin.index')->withErrors(['error' => 'Sorry, you are not authorized access to that']);
        }

        return $next($request);
    }
}
