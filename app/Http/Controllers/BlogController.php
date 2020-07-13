<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class BlogController extends Controller
{
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
        return view('blogs.index', [
            'blogs' => $blogs,
            'tags' => $tagsData,
            'categories' => $categories,
            'recent' => $recent
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
        //关联文章
        $related = Blog::query()
            ->where('enable', 1)
            ->orderBy('created_at')
            ->where('category_id', $article->category_id)->limit(5)->get();

        if (count($related) < 3) {
            dd('error');
        }
        return view('blogs.show', [
            'article' => $article,
            'recent' => $recent,
            'related' => $related,
            'categories' => []
        ]);
    }
}
