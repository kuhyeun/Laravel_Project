<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
// use App\Models\SystemMenu; // 나중에 실제 메뉴 모델을 사용하세요.

class AdminMenuComposer {
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void {
        // 로그인한 사용자만 메뉴를 로드합니다.
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        $cacheKey = "admin_menu_for_user_{$user->id}";

        // 60분 동안 메뉴를 캐시합니다.
        $adminMenu = Cache::remember($cacheKey, 60, function () use ($user) {
            
            // TODO: 1. 데이터베이스에서 메뉴를 조회하는 로직으로 변경하세요.
            // 예: $menu = SystemMenu::where('type', 'admin')->orderBy('order')->get();
            $menu = [
                (object)['name' => 'Admin Dashboard', 'location' => '/admin', 'on' => 'Y'],
                (object)['name' => 'User Management', 'location' => '/admin/users', 'on' => 'N'],
            ];

            // TODO: 2. 사용자의 권한($user->level)에 따라 메뉴를 필터링하는 로직을 추가하세요.
            // TODO: 3. 특정 조건(예: 새 알림)에 따라 배지를 추가하는 로직을 추가하세요.
            
            return $menu;
        });

        // 뷰에 'adminMenu' 변수를 전달합니다.
        $view->with('adminMenu', $adminMenu);
    }
}
