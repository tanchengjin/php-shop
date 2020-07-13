<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title'=>$faker->title('3'),
        'author'=>$faker->name,
        'image'=>$faker->imageUrl(),
        'tags'=>implode(',',$faker->words(5)),
        'content'=>$faker->sentence(230),
    ];
});
