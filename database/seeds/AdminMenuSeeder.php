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
            ],
            [
                'title' => '订单管理',
                'icon' => 'fa-bar-chart',
                'parent_id' => 0,
                'uri' => 'orders'
            ],
            [
                'title' => '系统设置',
                'icon' => 'fa-bar-chart',
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
                'icon' => 'fa-toggle-on',
                'uri' => 'contactUs'
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
                    'parent_id' => $parent_id
                ]);
                if (isset($menu['children']) && is_array($menu['children'])) {
                    $this->generateMenu($menu['children'], $id);
                }
            }
        }
    }
}
