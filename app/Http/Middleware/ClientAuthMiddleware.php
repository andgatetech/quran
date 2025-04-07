<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$gurads): Response
    {
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login')->with('error', 'You must log in.');
        }


    
        if (Auth::guard('client')->user()->user_role !== 'client') {
            Auth::guard('client')->logout();
            return redirect()->route('client.login')->with('error', 'Access denied.');
        }
    
        return $next($request);
    }
}
