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
            ]
        ];

        $this->generateMenu($menus);
    }

    private function generateMenu(array $menus, $parent_id = 0)
    {
        foreach ($menus as $menu) {
            if ($parent_id !== 0) {
                $menu['parent_id'] = $parent_id;
            }
            if (!\Illuminate\Support\Facades\DB::table('admin_menu')->where('title',$menu['title'])->exists()){
                $id = \Illuminate\Support\Facades\DB::table('admin_menu')->insertGetId($menu);

            }
            if (isset($menu['children']) && is_array($menu['children'])) {
                $this->generateMenu($menu['children'], $id);
            }
        }
    }
}
