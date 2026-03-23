<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu\Menu;
// use App\Models\SystemMenu; // 나중에 실제 메뉴 모델을 사용하세요.

class UserMenuComposer {
    
    public function compose(View $view): void {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        // TODO: 향후 권한별 메뉴를 제공해야 할 경우를 대비하여 사용자 ID 기반 캐시 키 유지
        $cacheKey = $user->getMenuCacheKey();

        $userMenu = Cache::remember($cacheKey, 60, function () use ($user) {
            $userLevel = $user->user_level;

            // is_use가 'Y'이고 is_display가 'Y'인 메뉴만 가져옵니다.
            // 현재 로그인한 사용자의 user_level에 맞는 메뉴만 필터링합니다.
            $menus = Menu::where('is_use', 'Y')
                ->where('is_display', 'Y')
                ->whereHas('menuOptions', function ($query) use ($userLevel) {
                    $query->where('user_level', $userLevel);
                })
                ->with(['menuOptions' => function ($query) use ($userLevel) {
                    // menuOptions 관계를 가져올 때, 현재 사용자 레벨에 맞는 것만 가져오고
                    // menu_sort를 기준으로 정렬합니다.
                    $query->where('user_level', $userLevel)->orderBy('menu_sort', 'asc');
                }])
                ->get()
                ->sortBy(function($menu) {
                    // 기본 정렬은 menu_level, 그 다음 menuOptions의 menu_sort 입니다.
                    // 필터링된 menuOptions가 항상 존재하므로 first()는 안전합니다.
                    return $menu->menu_level . '-' . ($menu->menuOptions->first()->menu_sort ?? 0);
                });
            
            // dd( $menus->toArray() );

            return $this->buildMenuTree($menus);
        });
        
        $view->with('userMenu', $userMenu);
    }

    private function buildMenuTree($menus, $parentMenuCode = null): array {
        $branch = [];

        // $menus 컬렉션에서 parent_menu_code가 일치하는 항목을 찾습니다.
        $children = $menus->filter(function ($menu) use ($parentMenuCode) {
            return $menu->parent_menu_code === $parentMenuCode;
        });

        foreach ($children as $child) {
            // 각 자식 메뉴에 대해 재귀적으로 하위 메뉴를 빌드합니다.
            $subMenus = $this->buildMenuTree($menus, $child->menu_code);
            if ($subMenus) {
                // stdClass 객체로 변환하여 'children' 속성을 추가합니다.
                $childItem = (object)$child->toArray();
                $childItem->children = $subMenus;
                $branch[] = $childItem;
            } else {
                $branch[] = (object)$child->toArray();
            }
        }

        return $branch;
    }
}
