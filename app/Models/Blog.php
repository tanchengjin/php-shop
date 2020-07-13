<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    #模型关联
    public function comments()
    {
        return $this->hasMany(BlogArticleComment::class, 'article_id', 'id');
    }

    public function articleComments($parent_id = null, $comments = null)
    {
        if (is_null($comments)) {
            $comments = $this->comments()->get();
        }

        return $comments->where('parent_id', $parent_id)->map(function ($comment) use ($comments) {
            #返回数据格式
            $data = [
                'id' => hashids_id($comment->id),
                'username' => $comment->user->name,
                'content' => $comment->content,
                'created_at' => toDateString($comment->created_at),
            ];
            #被回复者用户名
            if (!is_null($comment->parent_id)) {
                $data['reply'] = $comment->parent->user->name ?? '';
            }

            if ($comment->children()->exists()) {
                $data['children'] = $this->articleComments($comment->id, $comments);
            }

            return $data;
        });
    }

    #获取当前评论数量
    public function articleCommentLength($comments = null)
    {
        static $length = 0;

        ++$length;

        if (is_null($comments)) {
            $comments = $this->articleComments();
        }


        foreach ($comments as $index => $comment) {

            if (isset($comment['children'])) {
                $children = $comment['children'];
                unset($comment[$index]);
                $this->articleCommentLength($children);
            }
        }

        return $length;
    }
}
