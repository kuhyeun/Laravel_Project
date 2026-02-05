<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // 부모 Controller를 명시적으로 불러옵니다.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User\User; // User 모델의 정확한 네임스페이스 경로
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Laravel의 기본 인증 파사드
use Illuminate\Support\Facades\Hash; // 비밀번호 해싱/검증용

class UserController extends Controller {

    public function dashboard() {
        return view( 'welcome' );
    }

    public function showLoginForm() {
        return view( 'users.login' );
    }

    public function processLogin( Request $request ): RedirectResponse {
        $request->validate([
            'user_id' => ['required'],
            'password' => ['required']
        ]);

        $credentials = [
            'USER_ID' => $request->input( 'user_id' ),
            'password' => $request->input( 'password' ),
            'IS_USE' => true
        ];

        if( Auth::attempt( $credentials ) ) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            Session::put( 'user_idx', $user->ACCOUNT_IDX );
            Session::put( 'user_id', $user->USER_ID );
            Session::put( 'user_name', $user->USER_NAME );
            Session::put( 'user_type', $user->USER_TYPE );
            Session::put( 'user_level', $user->USER_LEVEL );

            return redirect()->route( 'user.dashboard' );
        }

        return back()->withErrors([
            'user_id' => '제공된 자격 증명이 기록과 일치하지 않습니다.',
        ])->onlyInput( 'user_id' );
    }
    
    public function showRegistrationForm() {
        return view( 'users.register' );
    }

    public function processRegistration( Request $request ): RedirectResponse {
        $messages = [
            'user_id.required'   => '아이디를 입력해주세요',
            'user_id.unique'     => '이미 사용 중인 아이디입니다.',
            'user_name.required' => '사용자 이름을 입력해주세요',
            'password.required'  => '비밀번호를 입력해주세요.',
            'password.min'       => '비밀번호는 최소 :min 글자 이상이어야 합니다.',
            'password.confirmed' => '비밀번호와 비밀번호 확인이 일치하지 않습니다.',
        ];

        $validated = $request->validate([
            'user_id' => ['required', 'string', 'max:255', 'unique:account_member,USER_ID'],
            'user_name' => ['required', 'string', 'max: 50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        $user = new User();
        $user->USER_ID    = $validated['user_id'];
        $user->USER_PW    = $validated['password'];
        $user->USER_NAME  = $validated['user_name'];
        $user->USER_LEVEL = 99;
        $user->IS_USE     = true;

        $user->save();

        return redirect()->route( 'user.login' )->with( 'success', '회원가입이 완료되었습니다. 로그인해주세요.' );
    }
    
    public function logout( Request $request ): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route( 'user.login' );
    }
}