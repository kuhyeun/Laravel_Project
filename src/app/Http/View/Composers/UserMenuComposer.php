<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
// use App\Models\SystemMenu; // 나중에 실제 메뉴 모델을 사용하세요.

class UserMenuComposer {
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void {
        if (!Auth::check()) {
            return;
        }
        
        $user = Auth::user();
        $cacheKey = "user_menu_for_user_{$user->id}";

        $userMenu = Cache::remember($cacheKey, 60, function () use ($user) {
            
            // TODO: 1. 데이터베이스에서 메뉴를 조회하는 로직으로 변경하세요.
            $menu = [
                (object)['name' => 'Dashboard', 'location' => '/dashboard', 'on' => 'Y'],
                (object)['name' => 'Profile', 'location' => '/profile', 'on' => 'N'],
            ];

            // TODO: 2. 배지(알림) 등을 추가하는 로직을 여기에 구현하세요.
            
            return $menu;
        });
        
        $view->with('userMenu', $userMenu);
    }
}
