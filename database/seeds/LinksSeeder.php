<?php

use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->handle();
    }

    private function handle(array $data = null)
    {
        if (is_null($data)) {
            $tmp = [
                'name' => 'company',
                'url' => '#'
            ];
            for ($i = 1; $i <= 6; $i++) {
                $data[] = [
                    'name' => $tmp['name'] . '_' . $i,
                    'url' => $tmp['url']
                ];
            }

            \Illuminate\Support\Facades\DB::table('links')->insert($data);
        }


    }
}
