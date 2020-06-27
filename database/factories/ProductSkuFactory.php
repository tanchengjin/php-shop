<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductSku;
use Faker\Generator as Faker;

$factory->define(ProductSku::class, function (Faker $faker) {
    $price=$faker->numberBetween(500,50000);
    return [
        'title'=>$faker->title,
        'description'=>$faker->sentence,
        'original_price'=>$price+$faker->randomNumber(3),
        'price'=>$price,
        'stock'=>$faker->randomNumber(5),
    ];
});
