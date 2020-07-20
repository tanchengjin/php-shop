<?php

use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'FREE SHIPPING',
                'content' => 'Free shipping on all US order or order above $200',
                'image' => asset('assets/img/about/shipping1.jpg'),
            ],
            [
                'title' => 'SUPPORT 24/7',
                'content' => 'Contact us 24 hours a day, 7 days a week',
                'image' => asset('assets/img/about/shipping2.jpg'),
            ],
            [
                'title' => '30 DAYS RETURN',
                'content' => 'Simply return it within 30 days for an exchange',
                'image' => asset('assets/img/about/shipping3.jpg'),
            ],
            [
                'title' => '100% PAYMENT SECURE',
                'content' => 'We ensure secure payment with PEV',
                'image' => asset('assets/img/about/shipping4.jpg'),
            ],

        ];

        $this->handle($data);
    }

    private function handle(array $data)
    {
        \App\Models\Support::query()->truncate();

        foreach ($data as $item) {
            \Illuminate\Support\Facades\DB::table('supports')->insert($item);
        }
    }
}
