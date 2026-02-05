<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // In Laravel, we can achieve the same with session checks.
        // We assume 'admin_id' is stored in the session upon successful admin login.
        if (!Session::has('admin_id')) {
            // If not logged in, redirect to the admin login page.
            // Note: We need to avoid an infinite redirect loop if the login page is also under the 'admin' prefix.
            if (!$request->is('admin/login')) {
                // You might want to return a proper response, e.g., redirect to a login page.
                // For now, we'll return a simple access denied message.
                return response('Access Denied. Please log in.', 403);
            }
        }

        return $next($request);
    }
}
