<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // 부모 Controller를 명시적으로 불러옵니다.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User; // 예시 인증을 위해 User 모델을 가져옵니다.
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Laravel의 기본 인증 파사드
use Illuminate\Support\Facades\Hash; // 비밀번호 해싱/검증용

class LoginController extends Controller {
    /**
     * 로그인 요청을 처리합니다. (POST /users/login)
     */
    public function processLogin(Request $request): RedirectResponse {
        // 1. 폼 데이터 유효성 검사
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Laravel의 기본 인증 시스템을 사용하여 로그인 시도
        // Auth::attempt()는 사용자의 email(또는 username)과 password를 확인하여
        // 일치하면 세션에 로그인 정보를 기록하고 true를 반환합니다.
        if (Auth::attempt($credentials)) {
            // 세션 재생성: 세션 고정 공격(Session Fixation)을 방지합니다.
            $request->session()->regenerate();

            // 예시: 로그인 성공 시 추가 세션 데이터 저장
            $user = Auth::user();
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            // ... 필요한 다른 세션 정보 저장 ...

            return redirect()->route('user.dashboard'); // 로그인 성공 후 대시보드로 이동 (예시 라우트 이름)
        }

        // 3. 로그인 실패 시 이전 페이지로 돌아가며 에러 메시지 전달
        return back()->withErrors([
            'email' => '제공된 자격 증명이 기록과 일치하지 않습니다.',
        ])->onlyInput('email'); // 이메일 필드만 이전 입력값 유지
    }

    /**
     * 로그아웃 요청을 처리합니다.
     */
    public function logout(Request $request): RedirectResponse {
        Auth::logout(); // Laravel의 기본 로그아웃 처리 (세션 무효화)

        // 세션 재생성 (보안을 위해)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login'); // 로그아웃 후 로그인 페이지로 이동
    }
}