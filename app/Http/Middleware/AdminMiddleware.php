<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // Check for specific permission if not explicitly admin role (flexible)
        if (auth()->user()->hasPermission('view_dashboard')) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
