<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminsiteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has is admin (role_id = 2) or superadmin (role_id = 1)
        if (!auth()->check() OR !in_array(auth()->user()->role->id, [1, 2])) {
            return redirect()->route('admin.index')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
