<?php

use Illuminate\Database\Seeder;

class ProductCommonSeeder extends Seeder
{
    #生成随机标签
    protected function getTags(): array
    {
        $tags = array_keys(\App\Models\Product::$tabsMap);
        $arr = [];
        $random_num = random_int(1, count($tags));
        $keys = array_rand($tags, $random_num);
        if (is_array($keys)) {
            foreach ($keys as $key) {
                array_push($arr, $tags[$key]);
            }
        } else {
            $arr = [$tags[$keys]];
        }
        return $arr;
    }

    protected function getCategoryRandom(): int
    {
        $category = \App\Models\Category::query()->inRandomOrder()->first();
        return $category->id;

    }
}
