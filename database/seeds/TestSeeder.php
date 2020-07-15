<?php

use Illuminate\Database\Seeder;

#测试数据生成
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //用户测试数据
            UserSeeder::class,
            //商品测试数据
            ProductSeeder::class,
            //地址测试数据
            AddressSeeder::class,
            //文章测试数据填充
            BlogSeeder::class,
            BlogArticleCommentSeeder::class,
            #支付图片
            PaymentImageSeeder::class
        ]);
    }
}
