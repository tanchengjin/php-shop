<?php

class ProductSeckillSeeder extends ProductCommonSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            $num = random_int(30, 100);

            $products = factory(\App\Models\Product::class, $num)->create([
                'type' => \App\Models\Product::TYPE_SECKILL
            ]);

            foreach ($products as $product) {
                $sku_r = random_int(1, 3);
                $skus = factory(\App\Models\ProductSku::class, $sku_r)->create([
                    'product_id' => $product->id
                ]);

                $num = random_int(1, 3);
                $productImage = factory(\App\Models\ProductImage::class, $num)->create([
                    'product_id' => $product->id
                ]);

                $product->update([
                    'price' => collect($skus)->min('price'),
                    'max_price' => collect($skus)->max('price'),
                    'tags' => $this->getTags(),
                    'category_id' => $this->getCategoryRandom(),
                ]);

                $end_at = [
                    \Carbon\Carbon::now()->addSeconds(random_int(3000, 30000)),
                    \Carbon\Carbon::now()->addMinutes(random_int(60, 3000)),
                    \Carbon\Carbon::now()->addDays(random_int(1, 7)),
                ];
                $key = array_rand($end_at);
                $product->seckill()->create([
                    'start_at' => \Carbon\Carbon::now(),
                    'end_at' => $end_at[$key],
                ]);
            }
        });
    }

}
