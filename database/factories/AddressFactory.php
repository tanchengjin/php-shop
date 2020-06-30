<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Address::class, function (Faker $faker) {

    $addresses = [
        ['北京', '北京', '直辖市'],
        ['山东省', '济南市', '市中区'],
        ['山东省', '济南市', '市中区'],
        ['山东省', '济南市', '市中区'],
        ['山东省', '济南市', '市中区'],
    ];
    $address = $faker->randomElement($addresses);
    return [
        'province' => $address[0],
        'city' => $address[1],
        'district' => $address[2],
        'zip' => 1233212,
        'contact_name' => $faker->name,
        'contact_phone' => $faker->phoneNumber,
    ];
});
