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
                UserSeeder::class,
                ProductSeeder::class,
                AddressSeeder::class
            ]);
        });
    }
}
