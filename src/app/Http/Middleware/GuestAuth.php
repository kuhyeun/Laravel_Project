<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAuth {

    public function handle(Request $request, Closure $next): Response {
        if( Auth::check() ) {
            return redirect()->route( 'user.dashboard' );
        }

        // 원래 URL 그대로 진행
        return $next($request);
    }
}
