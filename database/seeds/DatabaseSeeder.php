<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        \Illuminate\Support\Facades\DB::transaction(function () {
            $this->call([
                //后台菜单生成
                AdminMenuSeeder::class,
                //后台默认配置项
                ConfigxSeeder::class,
                //商品分类
                CategorySeeder::class,

                TestSeeder::class

            ]);
        });
    }
}
