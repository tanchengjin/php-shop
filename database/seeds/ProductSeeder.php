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
        $products=factory(\App\Models\Product::class,30)->create();

        foreach ($products as $product){
            $sku=factory(\App\Models\ProductSku::class,3)->create([
                'product_id'=>$product->id
            ]);

            $product->update([
                'price'=>collect($sku)->min('price')
            ]);

        }
    }
}
