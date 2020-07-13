<?php

use Illuminate\Database\Seeder;

class BlogArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $comments = factory(\App\Models\BlogArticleComment::class, 30)->create();

        for ($i = 0; $i <= random_int(100, 200); $i++) {
            $article = \App\Models\BlogArticleComment::query()->inRandomOrder()->first();
            factory(\App\Models\BlogArticleComment::class, 1)->create(['parent_id' => $article->id]);
        }
    }
}
