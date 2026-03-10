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
                    [
                        'menu_code' => '3001',
                        'menu_name' => '구매관리',
                        'menu_route_name' => 'item/order',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '3002',
                        'menu_name' => '발주서관리',
                        'menu_route_name' => 'item/order_sub',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '3003',
                        'menu_name' => '입고관리',
                        'menu_route_name' => 'item/import',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '3004',
                        'menu_name' => '출고관리',
                        'menu_route_name' => 'item/export',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '3005',
                        'menu_name' => '재고관리',
                        'menu_route_name' => 'item/stock',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '3006',
                        'menu_name' => '재고조정',
                        'menu_route_name' => 'item/stock_manage',
                        'is_admin' => 'N'
                    ],
                ]
            ],
            [
                'menu_code' => '4000',
                'menu_name' => '생산관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '4001',
                        'menu_name' => '생산계획관리',
                        'menu_route_name' => 'production/plan_manage',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '4002',
                        'menu_name' => '공정실적관리',
                        'menu_route_name' => 'production/process_performance',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '4003',
                        'menu_name' => '생산실적현황',
                        'menu_route_name' => 'production/progress',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '4004',
                        'menu_name' => '생산일정관리',
                        'menu_route_name' => 'production/schedule',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '4005',
                        'menu_name' => '외주관리',
                        'menu_route_name' => '',
                        'is_admin' => 'N',
                        'children' => [
                            [
                                'menu_code' => '4101',
                                'menu_name' => '외주 출고',
                                'menu_route_name' => 'production/outsourcing_export',
                                'is_admin' => 'N'
                            ],
                            [
                                'menu_code' => '4102',
                                'menu_name' => '외주 입고',
                                'menu_route_name' => 'production/outsourcing_import',
                                'is_admin' => 'N'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'menu_code' => '5000',
                'menu_name' => '제품관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '5001',
                        'menu_name' => '입고관리',
                        'menu_route_name' => 'item/product_import',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '5002',
                        'menu_name' => '출고관리',
                        'menu_route_name' => 'item/product_export',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '5003',
                        'menu_name' => '재고관리',
                        'menu_route_name' => 'item/product_stock',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '5004',
                        'menu_name' => '재고조정',
                        'menu_route_name' => 'item/product_stock_manage',
                        'is_admin' => 'N'
                    ],
                ]
            ],
            [
                'menu_code' => '6000',
                'menu_name' => '품질관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '6001',
                        'menu_name' => '입고검사',
                        'menu_route_name' => 'inspection/item_in',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '6002',
                        'menu_name' => '공정검사',
                        'menu_route_name' => 'inspection/process_performance',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '6003',
                        'menu_name' => '출고검사',
                        'menu_route_name' => 'inspection/item_out',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '6004',
                        'menu_name' => '품목별 불량이력',
                        'menu_route_name' => 'inspection/item_error_history',
                        'is_admin' => 'N'
                    ],
                ]
            ],
            [
                'menu_code' => '7000',
                'menu_name' => '출하관리',
                'menu_route_name' => '',
                'is_admin' => 'N',
                'children' => [
                    [
                        'menu_code' => '7001',
                        'menu_name' => '출하관리',
                        'menu_route_name' => 'shipment/regist',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '7002',
                        'menu_name' => '출하이력관리',
                        'menu_route_name' => 'shipment/history',
                        'is_admin' => 'N'
                    ],
                    [
                        'menu_code' => '7003',
                        'menu_name' => '거래명세서',
                        'menu_route_name' => 'shipment/receipt',
                        'is_admin' => 'N'
                    ],
                ]
            ],
        ];