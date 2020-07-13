<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogArticleComment;
use Faker\Generator as Faker;

$factory->define(BlogArticleComment::class, function (Faker $faker) {
    $user = \App\User::query()->inRandomOrder()->first();
    $article = \App\Models\Blog::query()->inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'article_id' => $article->id,
        'content' => $faker->sentence(10),
    ];
});
