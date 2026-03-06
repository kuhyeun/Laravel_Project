<?php

namespace Database\Seeders\Menu;

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {

    public function run(): void {
        $defaultOptions = [
            ['user_level' => 0, 'menu_sort' => 1],
            ['user_level' => 1, 'menu_sort' => 1],
            ['user_level' => 10, 'menu_sort' => 1],
            ['user_level' => 99, 'menu_sort' => 1],
        ];

        $menus = [
            [
                'menu_code' => '1000',
                'menu_name' => '기준정보관리',
                'menu_route_name' => '',
                'children' => [
                    [
                        'menu_code' => '1001',
                        'top_menu_code' => '1000',
                        'menu_name' => '사이트 설정',
                        'menu_route_name' => 'basic/config',
                    ],
                    [
                        'menu_code' => '1002',
                        'top_menu_code' => '1000',
                        'menu_name' => '사용자관리',
                        'menu_route_name' => 'basic/account',
                    ],
                ],
            ],
        ];

        foreach( $menus as $topMenuData ) {
            // 1. 최상위 메뉴 생성 (level 1)
            $topMenu = Menu::updateOrCreate(
                ['menu_code' => $topMenuData['menu_code']],
                [
                    'top_menu_code' => '****',
                    'parent_menu_code' => null,
                    'menu_name' => $topMenuData['menu_name'],
                    'menu_level' => 1,
                    'menu_route_name' => $topMenuData['menu_route_name'],
                    'is_use' => 'Y',
                    'is_display' => 'Y',
                    'is_admin' => 'N',
                    'create_account_idx' => 1
                ]
            );

            // 생성된 최상위 메뉴에 기본 옵션 추가
            $this->seedMenuOptions($topMenu, $defaultOptions);

            // 2. 하위 메뉴 생성 (level 2)
            if (!empty($topMenuData['children'])) {
                foreach ($topMenuData['children'] as $childMenuData) {
                    $childMenu = Menu::updateOrCreate(
                        ['menu_code' => $childMenuData['menu_code']],
                        [
                            'top_menu_code' => $childMenuData['top_menu_code'],
                            'parent_menu_code' => $topMenu->menu_code,
                            'menu_name' => $childMenuData['menu_name'],
                            'menu_level' => 2,
                            'menu_route_name' => $childMenuData['menu_route_name'],
                            'is_use' => 'Y',
                            'is_display' => 'Y',
                            'is_admin' => 'N',
                            'create_account_idx' => 1
                        ]
                    );

                    // 생성된 하위 메뉴에 기본 옵션 추가
                    $this->seedMenuOptions($childMenu, $defaultOptions);
                }
            }
        }
    }

    /**
     * 주어진 메뉴에 대한 옵션(권한, 순서) 데이터를 시딩하는 헬퍼 메소드
     *
     * @param Menu $menu
     * @param array $options
     * @return void
     */
    private function seedMenuOptions(Menu $menu, array $options): void {
        foreach ($options as $optionData) {
            $menu->menuOptions()->updateOrCreate(
                // 조건: 이 메뉴에 해당 user_level의 옵션이 있는가?
                [
                    'user_level' => $optionData['user_level']
                ],
                // 내용: 없다면 만들고, 있다면 menu_sort와 create_account_idx를 이 값으로 업데이트
                [
                    'menu_sort' => $optionData['menu_sort'],
                    'create_account_idx' => 1, // system admin
                ]
            );
        }
    }
}
