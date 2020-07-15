<?php

use Illuminate\Database\Seeder;

class PaymentImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'image' => asset('assets/images/paypal1.jpg'),
                'description' => ''
            ],
            [
                'image' => asset('assets/images/paypal2.jpg'),
                'description' => ''
            ],
            [
                'image' => asset('assets/images/paypal3.jpg'),
                'description' => ''
            ],
            [
                'image' => asset('assets/images/paypal4.jpg'),
                'description' => ''
            ],
            [
                'image'=>asset('assets/images/alipay.jpg'),
                'description'=>''
            ],
            [
                'image'=>asset('assets/images/unionpay.jpg'),
                'description'=>''
            ],
        ];

        $this->create($images);
    }


    private function create(array $images)
    {
        \Illuminate\Support\Facades\DB::transaction(function() use($images){
            \App\Models\PaymentSupportImage::query()->truncate();

            foreach ($images as $image){
                \App\Models\PaymentSupportImage::query()->create($image);
            }
        });
    }
}
