<?php

return [
            [
                'menu_code' => '1000',
                'menu_name' => '기준정보관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '1001',
                        'menu_name' => '사이트 설정',
                        'menu_route_name' => 'basic/config',
                        'is_admin' => 'Y'
                    ],
                    [
                        'menu_code' => '1002',
                        'menu_name' => '자사정보관리',
                        'menu_route_name' => 'basic/company',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '1003',
                        'menu_name' => '사용자관리',
                        'menu_route_name' => 'basic/account',
                        'is_admin' => 'Y'
                    ],
                    [
                        'menu_code' => '1004',
                        'menu_name' => '사용자권한관리',
                        'menu_route_name' => 'basic/account_auth',
                        'is_admin' => 'Y'
                    ],
                    [
                        'menu_code' => '1005',
                        'menu_name' => '메뉴관리',
                        'menu_route_name' => 'basic/menu',
                        'is_admin' => 'Y'
                    ],
                ],
            ],
            [
                'menu_code' => '2000',
                'menu_name' => '수주관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '2001',
                        'menu_name' => '수주관리',
                        'menu_route_name' => 'order/project',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '2002',
                        'menu_name' => '수주진행관리',
                        'menu_route_name' => 'order/project_progress',
                        'is_admin' => 'N'
                    ],
                ]
            ],
            [
                'menu_code' => '3000',
                'menu_name' => '자재관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    
                ]
            ],
            [
                'menu_code' => '4000',
                'menu_name' => '생산관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [

                ]
            ],
            [
                'menu_code' => '5000',
                'menu_name' => '제품관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [

                ]
            ],
            [
                'menu_code' => '6000',
                'menu_name' => '품질관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [

                ]
            ],
            [
                'menu_code' => '7000',
                'menu_name' => '출하관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    
                ]
            ],
        ];