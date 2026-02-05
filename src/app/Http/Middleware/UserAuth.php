<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (!Session::has('user_id')) {
            // 세션에 'user_id'가 없으면, 로그인 페이지로 리다이렉트시킵니다.
            // route('login')은 ->name('login')으로 지정된 라우트를 찾아줍니다.
            return redirect()->route('login');
        }

        // 세션에 'user_id'가 존재하면, 요청을 다음 단계(컨트롤러 등)로 보냅니다.
        return $next($request);
    }
}