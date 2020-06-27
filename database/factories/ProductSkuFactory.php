<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductSku;
use Faker\Generator as Faker;

$factory->define(ProductSku::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'description'=>$faker->sentence,
        'price'=>$faker->numberBetween(500,50000),
        'stock'=>$faker->randomNumber(5),
    ];
});
