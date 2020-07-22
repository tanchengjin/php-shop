<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(3),
        'subtitle'=>$faker->sentence(2),
        'description'=>$faker->sentence(500),
        'price'=>0,
        'max_price'=>0,
        'intro'=>$faker->sentence(20)
    ];
});
