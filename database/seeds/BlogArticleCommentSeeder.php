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

        $this->createComments($comments);
    }

    private function createComments($comments)
    {
        foreach ($comments as $comment) {
            $comm = factory(\App\Models\BlogArticleComment::class, 1)->create([
                'parent_id' => $comment->id,
                'article_id'=>$comment->article_id
            ]);
            $rand = random_int(1, 100);
            if ($rand >= 50) {
                $this->createComments($comm);
            }
        }
    }
}
