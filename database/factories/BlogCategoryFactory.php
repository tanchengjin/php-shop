<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogCategory;
use Faker\Generator as Faker;

$factory->define(BlogCategory::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
    ];
});
