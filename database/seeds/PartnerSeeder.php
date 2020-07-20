<?php

use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners=[
            [
                'image'=>asset('assets/images/partners/brand1.jpg'),
            ],
            [
                'image'=>asset('assets/images/partners/brand2.jpg'),
            ],
            [
                'image'=>asset('assets/images/partners/brand3.jpg'),
            ],
            [
                'image'=>asset('assets/images/partners/brand4.jpg'),
            ]
        ];

        $this->handle($partners);
    }

    private function handle(array $data){
        \App\Models\Partner::query()->truncate();
        foreach ($data as $item){
            \Illuminate\Support\Facades\DB::table('partners')->insert($item);
        }
    }
}
