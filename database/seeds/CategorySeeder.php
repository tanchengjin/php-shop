<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => '电子产品',
                'children' => [
                    [
                        'title' => '手机',
                    ], [
                        'title' => '相机',
                    ], [
                        'title' => '电脑',
                    ], [
                        'title' => '智能手表',
                    ], [
                        'title' => '蓝牙耳机',
                    ],
                ],
            ], [
                'title' => '家用电器',
                'children' => [
                    [
                        'title' => '洗衣机'
                    ], [
                        'title' => '冰箱'
                    ]
                ]
            ]
        ];
        foreach ($categories as $category) {
            $this->createCategory($category);
        }
    }

    private function createCategory($data, $parent = null)
    {
        $category = new \App\Models\Category([
            'title' => $data['title']
        ]);
        $category->is_directory = isset($data['children']);
        if (!is_null($parent)) {
            $category->parent()->associate($parent);
        }

        $category->save();

        if (isset($data['children']) && is_array($data['children'])) {
            foreach ($data['children'] as $child) {
                $this->createCategory($child, $category);
            }
        }
    }
}
