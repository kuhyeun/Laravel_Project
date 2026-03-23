<?php

namespace App\Observers;

use App\Models\User\User; // User 모델을 use
use Illuminate\Support\Facades\Auth; // 현재 로그인한 사용자 ID를 가져오기 위해

class UserObserver {
    /**
     * 모델이 처음 생성되기 직전에 실행됩니다.
     */
    public function creating(User $user): void {
        if( Auth::check() ) { // 로그인한 사용자가 있다면
            $user->CREATE_ACCOUNT_IDX = Auth::id(); // 현재 로그인한 사용자 ID 할당
        }
    }

    /**
     * 모델이 업데이트되기 직전에 실행됩니다.
     */
    public function updating( User $user ): void {
        if( Auth::check() ) {
            $user->UPDATE_ACCOUNT_IDX = Auth::id(); // 현재 로그인한 사용자 ID 할당
        }
    }
}
