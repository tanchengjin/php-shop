<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductSku;
use Faker\Generator as Faker;

$factory->define(ProductSku::class, function (Faker $faker) {
    $price = 0.01;
    return [
        'title' => $faker->title,
        'description' => $faker->sentence,
        'original_price' => $price + $faker->randomNumber(3),
        'price' => $price,
        'stock' => $faker->randomNumber(5),
    ];
});
