<?php


class AdminMenuSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $menus = [
            [
                'title' => '产品管理',
                'icon' => 'fa-bar-chart',
                'parent_id' => 0,
                'uri' => 'products',
                'order' => 2,
            ],
            [
                'title' => '订单管理',
                'icon' => 'fa-bar-chart',
                'parent_id' => 0,
                'order' => 3,
                'children' => [
                    [
                        'title' => '全部订单',
                        'icon' => 'fa-reorder',
                        'uri' => 'orders'
                    ],
                    [
                        'title' => '代发货订单',
                        'icon' => 'fa-reorder',
                        'uri' => 'orders-deliver'
                    ],
                    [
                        'title' => '待退款订单',
                        'icon' => 'fa-reorder',
                        'uri' => 'orders-refund'
                    ],
                ],
            ],
            [
                'title' => '系统设置',
                'icon' => 'fa-cogs',
                'order' => 6,
                'children' => [
                    [
                        'title' => '基础设置',
                        'icon' => 'fa-toggle-on',
                        'uri' => 'config'
                    ], [
                        'title' => '高级设置',
                        'icon' => 'fa-toggle-on',
                        'uri' => 'configx/edit'
                    ], [
                        'title' => '支持支付方式图片',
                        'icon' => 'fa-toggle-on',
                        'uri' => 'paymentImage'
                    ]
                ],
            ],
            [
                'title' => '留言管理',
                'icon' => 'fa-commenting-o',
                'uri' => 'contactUs',
                'order' => 5
            ], [
                'title' => '用户管理',
                'icon' => 'fa-user-md',
                'uri' => 'users',
                'order' => 4
            ]
        ];

        $this->generateMenu($menus);
    }

    private function generateMenu(array $menus, $parent_id = 0)
    {
        foreach ($menus as $menu) {

            if (!\Illuminate\Support\Facades\DB::table('admin_menu')->where('title', $menu['title'])->exists()) {
                $id = \Illuminate\Support\Facades\DB::table('admin_menu')->insertGetId([
                    'title' => $menu['title'],
                    'icon' => $menu['icon'],
                    'uri' => $menu['uri'] ?? '',
                    'parent_id' => $parent_id,
                    'order'=>$menu['order']??0
                ]);
                if (isset($menu['children']) && is_array($menu['children'])) {
                    $this->generateMenu($menu['children'], $id);
                }
            }
        }
    }
}
