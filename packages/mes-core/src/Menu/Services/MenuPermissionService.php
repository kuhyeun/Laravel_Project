<?php

namespace MesCore\Menu\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use MesCore\Auth\Models\User;
use MesCore\Menu\Models\Menu;

class MenuPermissionService {

    private const CACHE_TTL = 60;

    public function getForUser(User $user): array {
        return Cache::remember($user->getMenuCacheKey(), self::CACHE_TTL, function () use ($user) {
            return $this->buildPayload($user);
        });
    }

    public function can(User $user, string $menuCode, string $action): bool {
        $payload = $this->getForUser($user);

        if (!empty($payload['bypass'])) {
            return true;
        }

        $perm = $payload['permissions'][$menuCode] ?? null;
        if ($perm === null) {
            return false;
        }

        return (bool)($perm[$action] ?? false);
    }

    public function forgetForUser(User $user): void {
        Cache::forget($user->getMenuCacheKey());
    }

    private function buildPayload(User $user): array {
        $userLevel = $user->user_level;

        $defaultModules = ['Basic'];
        if (config('app.debug') == true) {
            $defaultModules[] = 'Debug';
        }
        $activeModules = array_merge($defaultModules, config('mes.modules', []));

        $isBypass = ($userLevel <= 1);

        $menus = Menu::select(
                'system_menu.menu_idx',
                'system_menu.menu_name',
                'system_menu.menu_code',
                'system_menu.parent_menu_code',
                'system_menu.menu_route_name',
                'system_menu.menu_icon',
                'system_menu.menu_depth'
            )
            ->where('system_menu.is_use', 'Y')
            ->where('system_menu.is_display', 'Y')
            ->whereIn('system_menu.module_code', $activeModules)
            ->whereHas('menuOptions', function ($query) use ($userLevel) {
                $query->where('menu_level', $userLevel);
            })
            ->with(['menuOptions' => function ($query) use ($userLevel) {
                $query->where('menu_level', $userLevel)->orderBy('menu_sort', 'asc');
            }])
            ->get();

        if (!$isBypass) {
            $overrides = DB::table('account_menu_permission')
                ->where('account_idx', $user->account_idx)
                ->whereIn('menu_idx', $menus->pluck('menu_idx'))
                ->get()
                ->keyBy('menu_idx');

            $menus = $menus->filter(function ($menu) use ($overrides) {
                $row = $overrides->get($menu->menu_idx);
                if ($row && $row->can_read === 'N') {
                    return false;
                }
                return true;
            })->values();
        } else {
            $overrides = collect();
        }

        $permissions = [];
        foreach ($menus as $menu) {
            // Bypass 계정의 경우 모든 권한획득 ( ex. system, admin )
            if ($isBypass) {
                $permissions[$menu->menu_code] = [
                    'can_read'   => true,
                    'can_write'  => true,
                    'can_delete' => true,
                ];
                continue;
            }

            $row = $overrides->get($menu->menu_idx);
            if ($row) {
                $permissions[$menu->menu_code] = [
                    'can_read'   => $row->can_read   === 'Y',
                    'can_write'  => $row->can_write  === 'Y',
                    'can_delete' => $row->can_delete === 'Y',
                ];
            } else {
                $permissions[$menu->menu_code] = [
                    'can_read'   => true,
                    'can_write'  => false,
                    'can_delete' => false,
                ];
            }
        }

        $sorted = $menus->sortBy(function ($menu) {
            return $menu->menu_depth . '-' . ($menu->menuOptions->first()->menu_sort ?? 0);
        });

        return [
            'bypass'      => $isBypass,
            'menus'       => $this->buildMenuTree($sorted),
            'permissions' => $permissions,
        ];
    }

    private function buildMenuTree(Collection $menus, ?string $parentMenuCode = null): array {
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
