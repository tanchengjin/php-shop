<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogArticleComment extends Model
{
    protected $fillable = ['parent_id', 'article_id', 'content', 'user_id'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function (BlogArticleComment $comment) {
            if (is_null($comment->parent_id)) {
                $comment->level = 0;
                $comment->path = '-';
            } else {
                $comment->level = $comment->parent->level + 1;
                $comment->path = $comment->parent->path . $comment->parent->id . '-';
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(BlogArticleComment::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(BlogArticleComment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function recentComment($limit = 3)
    {
        return self::query()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}