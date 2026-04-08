<?php

namespace MesCore\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth {

    public function handle(Request $request, Closure $next): Response {
        if( !$request->session()->has('user_level') || $request->session()->get('user_level') > 1 ) {
            return response( 'Permission Denied.', 403 );
        }

        return $next($request);
    }
}
