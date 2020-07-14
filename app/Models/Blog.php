<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

            #当前用户是否可以评论
            $data['isReply'] = false;
            if (Auth::check()) {
                #用户不能回复自己的评论
                $data['isReply'] = $comment->user_id === Auth::id() ? false : true;
            }

            #用户头像
            $data['avatar'] = Auth::user()->full_avatar;

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

        if (is_null($comments)) {
            $comments = $this->articleComments();
        }


        foreach ($comments as $index => $comment) {
            ++$length;


            if (isset($comment['children'])) {
                $children = $comment['children'];
                unset($comment[$index]);
                $this->articleCommentLength($children);
            }
        }

        return $length;
    }
}
