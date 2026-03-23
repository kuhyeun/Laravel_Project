<?php

namespace Database\Seeders\Menu;

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder {

    public function run(): void {
        $menus = config( 'menus' );

        foreach( $menus as $topMenuData ) {
            $this->seedMenu( $topMenuData, $topMenuData['menu_code'] );
        }

        $this->setMenuSort();
    }

    private function seedMenu( Array $menuData, String $topMenuCode, String $parentMenuCode = "", int $level = 1 ): void {
        $menu = Menu::updateOrCreate(
            ['menu_code' => $menuData['menu_code']],
            [
                'top_menu_code' => $level == 1 ? '****': $topMenuCode,
                'parent_menu_code' => $level == 1 ? null : $parentMenuCode,
                'menu_name' => $menuData['menu_name'],
                'menu_icon' => $menuData['menu_icon'],
                'menu_level' => $level,
                'menu_route_name' => $menuData['menu_route_name'],
                'is_use' => 'Y',
                'is_display' => 'Y',
                'is_admin' => $menuData['is_admin'],
                'create_account_idx' => 1
            ]
        );

        $this->seedMenuOptions( $menu );

        if( !empty( $menuData['children'] ) ) {
            $childLevel     = ++$level;
            $parentMenuCode = $menuData['menu_code'];

            foreach( $menuData['children'] as $childMenuData ) {
                $this->seedMenu( $childMenuData, $topMenuCode, $parentMenuCode, $childLevel );
            }
        }
    }

    private function seedMenuOptions( Menu $menu ): void {
        $menu_levels = [ 0, 1, 10, 99 ];

        if( $menu->is_admin == 'Y' ) {
            $menu_levels = [ 0, 1 ];
        }

        foreach( $menu_levels as $level ) {
            $menu->menuOptions()->updateOrCreate(
                [
                    'user_level' => $level
                ],
                [
                    'menu_sort' => 1,
                    'create_account_idx' => 1,
                ]
            );
        }
    }

    private function setMenuSort() {
        $sql = <<<SQL
            WITH MenuSortCTE AS (
                SELECT smo.menu_option_idx,
                       ROW_NUMBER() OVER (
                           PARTITION BY sm.parent_menu_code, smo.user_level
                           ORDER BY sm.menu_level, sm.menu_code
                       ) AS rn
                  FROM system_menu AS sm
                 INNER JOIN system_menu_option AS smo ON sm.menu_idx = smo.menu_idx
            )
            UPDATE system_menu_option AS smo_target
              JOIN MenuSortCTE ON smo_target.menu_option_idx = MenuSortCTE.menu_option_idx
               SET smo_target.menu_sort = MenuSortCTE.rn;
        SQL;

        DB::statement( $sql );
    }
}
