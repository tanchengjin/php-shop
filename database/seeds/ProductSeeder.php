<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array_keys(\App\Models\Product::$tabsMap);
        \Illuminate\Support\Facades\DB::transaction(function () use ($tags) {
            $products = factory(\App\Models\Product::class, 30)->create();
            foreach ($products as $product) {

                $sku = factory(\App\Models\ProductSku::class, 3)->create([
                    'product_id' => $product->id
                ]);

                $num = random_int(1, 3);
                $productImage = factory(\App\Models\ProductImage::class, $num)->create([
                    'product_id' => $product->id
                ]);


                $product->update([
                    'price' => collect($sku)->min('price'),
                    'max_price' => collect($sku)->max('price'),
                    'tags' => $this->getTags($tags),
                    'category_id' => $this->getCategoryRandom(),
                ]);

            }
        });
    }

    #生成随机标签
    private function getTags(array $tags): array
    {
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

    private function getCategoryRandom(): int
    {
        $category = \App\Models\Category::query()->inRandomOrder()->first();
        return $category->id;

    }
}
