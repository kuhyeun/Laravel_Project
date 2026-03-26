<?php

namespace App\Observers;

use App\Models\User\User; // User 모델을 use
use Illuminate\Support\Facades\Auth; // 현재 로그인한 사용자 ID를 가져오기 위해

class UserObserver {
    
    // 모델 생성 전 실행
    public function creating( User $user ): void {
        if( Auth::check() ) { // 로그인한 사용자가 있다면
            $user->CREATE_ACCOUNT_IDX = Auth::id(); // 현재 로그인한 사용자 ID 할당
        }
    }

    // 모델 생성 후 실행
    public function created( User $user ): void {

    }

    // 모델 업데이트 전 실행
    public function updating( User $user ): void {
        if( Auth::check() ) {
            $user->UPDATE_ACCOUNT_IDX = Auth::id(); // 현재 로그인한 사용자 ID 할당
        }
    }

    // 모델 업데이트 후 실행
    public function updated( User $user ): void {

    }
}
