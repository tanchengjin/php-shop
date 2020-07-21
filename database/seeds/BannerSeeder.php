<?php

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            [
                'title' => 'Vegetables Big Sale',
                'subtitle' => 'Fresh Farm Products',
                'content' => '10% certifled-organic mix of fruit and veggies. Perfect for weekly cooking and
                                    snacking!',
                'image' => asset('assets/images/slider/slider1.jpg'),
            ],
            [
                'title' => 'Fresh Vegetables',
                'subtitle' => 'Natural Farm Products',
                'content' => 'Widest range of farm-fresh Vegetables, Fruits & seasonal produce',
                'image' => asset('assets/images/slider/slider2.jpg'),
            ],
            [
                'title' => 'Fresh Tomatoes',
                'subtitle' => 'Natural Farm Products',
                'content' => 'Natural organic tomatoes make your health stronger. Put your information here',
                'image' => asset('assets/images/slider/slider3.jpg'),
            ]
        ];

        $this->handle($banners);
    }

    private function handle(array $banners)
    {
        \App\Models\Banner::query()->truncate();

        foreach ($banners as $banner) {
            \Illuminate\Support\Facades\DB::table('banners')->insert($banner);
        }
    }
}
