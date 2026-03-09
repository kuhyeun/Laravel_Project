<?php

namespace Database\Seeders\Menu;

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {

    public function run(): void {
        $menus = config( 'menus' );

        foreach( $menus as $topMenuData ) {
            $this->seedMenu( $topMenuData, $topMenuData['menu_code'] );
        }
    }

    private function seedMenu( Array $menuData, String $topMenuCode, String $parentMenuCode = "", int $level = 1 ): void {
        $menu = Menu::updateOrCreate(
            ['menu_code' => $menuData['menu_code']],
            [
                'top_menu_code' => $level == 1 ? '****': $topMenuCode,
                'parent_menu_code' => $level == 1 ? null : $parentMenuCode,
                'menu_name' => $menuData['menu_name'],
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
}
