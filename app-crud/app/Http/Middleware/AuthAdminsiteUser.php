<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminsiteUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has an admin role
        if (!auth()->check() OR !auth()->user()->role->id) {
            #dd(auth()->user()->role->id);
            #dd(auth()->user()->role);
            return redirect()->route('adminsite.login')->withErrors(['error' => 'Please login first']);
        }

        return $next($request);
    }

    
    protected function isInAdminsTable()
    {
        // Logic to check if the user exists in the admins table
        return Admin::where('user_id', $this->id)->exists();
    }
}
