<?php

use Illuminate\Database\Seeder;

class ConfigxSeeder extends Seeder
{
    private $configs = [
        'base.title' => [
            'options' => [],
            'element' => 'normal',
            'help' => null,
            'name' => '网站名',
            'order' => 1
        ],
        'base.intro' => [
            'options' => [],
            'element' => 'textarea',
            'help' => null,
            'name' => '网站简介',
            'order' => 2
        ],
        'base.copyright' => [
            'options' => [],
            'element' => 'normal',
            'help' => null,
            'name' => '版权信息',
            'order' => 3
        ],
        'base.email' => [
            'options' => [],
            'element' => 'normal',
            'help' => null,
            'name' => '邮箱信息',
            'order' => 4
        ],
        'base.telephone' => [
            'options' => [],
            'element' => 'normal',
            'help' => null,
            'name' => '联系电话',
            'order' => 5
        ],
        'base.address' => [
            'options' => [],
            'element' => 'normal',
            'help' => null,
            'name' => '地址',
            'order' => 6
        ],
        'base.logo' => [
            'options' => [],
            'element' => 'image',
            'help' => '请上传118x28像素的图片',
            'name' => '网站Logo图',
            'order' => 7
        ],
    ];

    private $configsValue = [
        'base.title' => 'Shop',
        'base.intro' => 'description',
        'base.copyright' => 'Copyright © 2020.Company Name All Rights Reserved.',
        'base.email' => 'demo@xxxxxxxxxx.com',
        'base.telephone' => '(xx) xxxxxx',
        'base.address' => 'Address Address',
        'base.logo' => '',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createConfigx($this->configs);
    }

    private function createConfigx(array $configs)
    {
        $this->configsValue['base.logo'] = asset('assets/img/logo/logo.png');

        $description = json_encode($configs);
        if (!\Illuminate\Support\Facades\DB::table('admin_config')->where('name', '__configx__')->exists()) {
            \Illuminate\Support\Facades\DB::table('admin_config')->insert([
                'name' => '__configx__',
                'value' => 'do not Delete'
            ]);
        }

        \Illuminate\Support\Facades\DB::table('admin_config')->where('name', '__configx__')->update([
            'description' => $description
        ]);
        foreach ($configs as $index => $config) {
            if (!\Illuminate\Support\Facades\DB::table('admin_config')->where('name', $index)->exists()) {
                \Illuminate\Support\Facades\DB::table('admin_config')->insert([
                    'name' => $index,
                    'value' => $this->configsValue[$index],
                ]);
            }
        }
    }
}
