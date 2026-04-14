<?php

namespace MesCore\Http;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use MesCore\Menu\Models\Menu;

class HandleInertiaRequests extends Middleware {

    public function share(Request $request): array {
        return array_merge(parent::share($request), [
            'userMenu' => $this->getUserMenu(),
        ]);
    }

    private function getUserMenu(): array {
        if (!Auth::check()) {
            return [];
        }

        $user = Auth::user();

        return Cache::remember($user->getMenuCacheKey(), 60, function () use ($user) {
            $userLevel = $user->user_level;

            $defaultModules = ['Basic'];

            if( config( 'app.debug' ) == true ) {
                $defaultModules[] = 'Debug';
            }

            $activeModules = array_merge( $defaultModules, config('mes.modules', []) );

            $menus = Menu::select('menu_name','menu_code','parent_menu_code','menu_route_name','menu_icon','menu_depth')
                ->where('is_use', 'Y')
                ->where('is_display', 'Y')
                ->whereIn('module_code', $activeModules)
                ->whereHas('menuOptions', function ($query) use ($userLevel) {
                    $query->where('menu_level', $userLevel);
                })
                ->with(['menuOptions' => function ($query) use ($userLevel) {
                    $query->where('menu_level', $userLevel)->orderBy('menu_sort', 'asc');
                }])
                ->get()
                ->sortBy(function ($menu) {
                    return $menu->menu_depth . '-' . ($menu->menuOptions->first()->menu_sort ?? 0);
                });

            return $this->buildMenuTree($menus);
        });
    }

    private function buildMenuTree($menus, $parentMenuCode = null): array {
        $branch = [];

        $children = $menus->filter(function ($menu) use ($parentMenuCode) {
            return $menu->parent_menu_code === $parentMenuCode;
        });

        foreach ($children as $child) {
            $subMenus = $this->buildMenuTree($menus, $child->menu_code);
            $childItem = $child->toArray();
            if ($subMenus) {
                $childItem['children'] = $subMenus;
            }
            $branch[] = $childItem;
        }

        return $branch;
    }
}
