<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\ArticleCommentRequest;
use App\Librarys\API;
use App\Models\Blog;
use App\Models\BlogArticleComment;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class BlogController extends Controller
{
    use API;

    public function index(Request $request)
    {
        $builder = Blog::query()->where('enable', 1);

        $tagsData = [];
        $res = $builder->get('tags')->map(function ($data) use (&$tagsData) {
            $tag = explode(',', $data['tags']);
            foreach ($tag as $item) {
                if (!in_array($item, $tagsData)) {
                    array_push($tagsData, $item);
                }
            }
        });

        $categories = BlogCategory::all();

        if ($search = $request->get('q')) {
            $like = '%' . $search . '%';
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('tags', 'like', $like);
            });
        }

        if ($tags = $request->get('tags')) {
            //TODO tags
            $like = '%' . $tags . '%';
            $builder->where('tags', 'like', $like);
        }

        if ($c_id = $request->get('category_id')) {
            //TODO category
            $builder->where('category_id', $c_id);
        }
        $blogs = $builder->paginate(15);

        $recent = Blog::query()->orderBy('created_at')->limit(3)->get();
        #获取最近的三篇文章
        $recentComment = (new BlogArticleComment)->recentComment();

        return view('blogs.index', [
            'blogs' => $blogs,
            'tags' => $tagsData,
            'categories' => $categories,
            'recent' => $recent,
            'recentComment' => $recentComment
        ]);
    }

    public function show($id)
    {
        $ids = Hashids::connection('blog_id')->decode($id);
        if (empty($ids)) {
            throw new NotFoundException('文章未找到');
        }

        $id = $ids[0];

        $article = Blog::findOrFail($id);

        if (!$article->enable) {
            throw new NotFoundException('文章已下架');
        }
        //最近文章
        $recent = Blog::query()->where('enable', 1)
            ->orderBy('created_at', 'desc')
            ->limit(3)->get();
        //获取当前文章的关联文章
        $related = Blog::query()
            ->where('enable', 1)
            ->orderBy('created_at')
            ->where('category_id', $article->category_id)->limit(5)->get();


        #获取最近的三篇评论
        $recentComment = (new BlogArticleComment)->recentComment();

        return view('blogs.show', [
            'article' => $article,
            'recent' => $recent,
            'related' => $related,
            'categories' => [],
            'recentComment' => $recentComment
        ]);
    }


    public function comment(ArticleCommentRequest $request)
    {
        try {
            $parent_id = $request->input('id', null);
            if (!is_null($parent_id)) {
                $parent_id = hashids_id_decode($parent_id);
            }
            $article_id = hashids_id_decode($request->input('article'));

            $comment = $request->input('comment');

            if (strstr($comment, ':')) {
                $comment = explode(':', $comment)[1];
            }


            $result = BlogArticleComment::query()->create([
                'user_id' => Auth::id(),
                'parent_id' => $parent_id,
                'article_id' => $article_id,
                'content' => $comment,
            ]);
            return $this->success();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->error();
        }
    }
}
