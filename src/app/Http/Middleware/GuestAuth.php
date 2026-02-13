<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illiminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAuth {

    public function handle(Request $request, Closure $next): Response {

        if( Auth::check() ) {
            return redirect( 'user.dashboard' );
        }

        // 원래 URL 그대로 진행
        return $next($request);
    }
}
