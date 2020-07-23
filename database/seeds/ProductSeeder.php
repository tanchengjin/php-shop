<?php

class ProductSeeder extends ProductCommonSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            $rand = random_int(100, 300);
            $products = factory(\App\Models\Product::class, $rand)->create();
            foreach ($products as $product) {
                $r_i = random_int(1, 3);
                $sku = factory(\App\Models\ProductSku::class, $r_i)->create([
                    'product_id' => $product->id
                ]);

                $num = random_int(1, 3);
                $productImage = factory(\App\Models\ProductImage::class, $num)->create([
                    'product_id' => $product->id
                ]);


                $product->update([
                    'price' => collect($sku)->min('price'),
                    'max_price' => collect($sku)->max('price'),
                    'tags' => $this->getTags(),
                    'category_id' => $this->getCategoryRandom(),
                ]);

            }
        });
    }
}
