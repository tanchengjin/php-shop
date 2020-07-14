<?php

namespace App\Http\Requests;

use App\Exceptions\NotFoundException;
use App\Models\BlogArticleComment;
use Illuminate\Foundation\Http\FormRequest;

class ArticleCommentRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => function ($key, $value, $fail) {
                if (!is_null($value)) {
                    $comment_id = hashids_id_decode($value);
                    if (!$comment = BlogArticleComment::query()->where('id', $comment_id)->first()) {
                        throw new NotFoundException();
                    }
                    #不可回复自己的评论
                    if ($comment->user_id === $this->user()->id) {
                        throw new NotFoundException('不可回复自己的评论');
                    }
                }
            },
            'comment' => ['required', 'max:255', 'min:2'],
            'article'=>['required']
        ];
    }
}
