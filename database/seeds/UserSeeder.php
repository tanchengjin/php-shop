<?php


class UserSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        factory(\App\User::class,30)->create();
    }
}
