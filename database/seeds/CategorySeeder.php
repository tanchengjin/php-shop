<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $categories = [
        [
            'title' => '电子产品',
            'children' => [
                [
                    'title' => '手机',
                    'children' => [
                        [
                            'title' => '智能手机',
                        ],
                        [
                            'title' => '普通手机'
                        ]
                    ],
                ],
                [
                    'title' => '相机',
                ],
                [
                    'title' => '电脑',
                ],
                [
                    'title' => '智能手表',
                ],
                [
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

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $this->handle($category);
        }
    }


    private function handle($data, $parent = null)
    {
        $category = new \App\Models\Category([
            'title' => $data['title']
        ]);
        $category->is_directory = isset($data['children']);

        if (!is_null($parent)) {
            $category->parent()->associate($parent);
        }

        $category->save();
        if (isset($data['children']) && !empty($data['children']) && is_array($data['children'])) {
            foreach ($data['children'] as $children) {
                $this->handle($children, $category);
            }
        }
    }
}
