<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    #默认redis过期时间为半个小时
    private $redis_expire = 1800;

    public function index(Request $request)
    {
        $builder = Product::query()->where('on_sale', 1)->with(['skus', 'images'])->orderBy('created_at', 'desc');

        #排序
        if ($order = $request->input('order', '')) {
            #排序规则
            $rules = ['review', 'rating', 'price', 'sold'];

            $rule = implode('|', $rules);
            preg_match('/^(' . $rule . ')_(asc|desc)$/', $order, $m);

            if (!empty($m)) {
                list($full, $order_key, $order_value) = $m;

                if ($order_key === 'review') {
                    $order_key = 'review_count';
                }

                if ($order_key === 'sold') {
                    $order_key = 'sold_count';
                }

                $builder->orderBy($order_key, $order_value);
            }
        }

        #分类
        if ($request->get('category_id', '') && $category = Category::find($request->get('category_id'))) {
            if ($category->is_directory) {
                $builder->where(function ($builder) use ($category) {
                    $builder->whereHas('category', function ($query) use ($category) {
                        $query->where('path', 'like', $category->path . $category->id . '-%');
                    })->orWhere('category_id', $category->id);
                });
            } else {
                $builder->where('category_id', $category->id);
            }
        }
        #搜索
        if ($search = $request->input('q', '')) {
            $like = '%' . $search . '%';
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)->orWhere('intro', 'like', $like);
            });
        }

        $products = $builder->paginate(20);

        return view('products.index', [
            'products' => $products,
            'param' => [
                'order' => $order,
                'search' => $search
            ],
        ]);
    }

    public function show($id)
    {
        $redis = false;
        $product = $this->getProductById($id, $redis);

        #相关商品
        $product_relate = $this->getRelateProduct($product, 9, $redis);
        #促销商品
        $product_sale = $this->getSaleProduct(9, $redis);
        #获取商品的评论
        $comments = $this->getCommentByProduct($product);

        return view('products.show', [
            'product' => $product,
            'product_relate' => $product_relate,
            'product_sale' => $product_sale,
            'comments'=>$comments
        ]);
    }

    private function getRedisByKey($key)
    {
        return Redis::exists($key) ? unserialize(Redis::get($key)) : false;
    }

    private function setRedisByKey($key, $value, $ttl = null)
    {
        if (is_null($ttl)) {
            $ttl = $this->redis_expire;
        }
        Redis::set($key, serialize($value));
        Redis::expire($key, $ttl);
    }

    #获取商品
    private function getProductById($id, $redis = false)
    {
        if (!$redis) {
            #数据库处理
            $product = $this->getProductModel(['images', 'skus'])->find($id);
        } else {
            #redis处理
            $redisKey = 'product:show:' . $id;
            if (!$product = $this->getRedisByKey($redisKey)) {
                if (!$product = $this->getProductModel(['images', 'skus'])->find($id)) {
                    abort(404);
                }
                $this->setRedisByKey($redisKey, $product);
            }
            $product->increment('click');
        }

        return $product;
    }

    private function getRelateProduct(Product $product, $limit = 9, $redis = false)
    {

        if ($redis) {
            #Redis处理
            $relateRedisKey = 'product:relate';
            if (!$product_relate = $this->getRedisByKey($relateRedisKey)) {
                $product_relate = $this->getProductModel()->where(function ($query) use ($product) {
                    $query->where('category_id', $product->category_id)->orWhere('title', 'like', '%' . $product->title . '%');
                })->orderBy('created_at', 'desc')->limit($limit)->get();
                $this->setRedisByKey($relateRedisKey, $product_relate);
            }
        } else {
            //数据库处理
            $product_relate = Product::query()->where('on_sale', 1)->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)->orWhere('title', 'like', '%' . $product->title . '%');
            })->orderBy('created_at', 'desc')->limit($limit)->get();
        }

        return $product_relate;
    }

    private function getSaleProduct($limit = 9, $redis = false)
    {
        if ($redis) {
            $saleRedisKey = 'product:sale';
            if (!$product_sale = $this->getRedisByKey($saleRedisKey)) {
                $product_sale = $this->getProductModel()
                    ->where('tags', 'like', '%sale%')
                    ->limit(9)
                    ->get();
                $this->setRedisByKey($saleRedisKey, $product_sale);
            }
        } else {
            $product_sale = $this->getProductModel()
                ->where('tags', 'like', '%sale%')
                ->with('images')->limit(9)
                ->get();
        }

        return $product_sale;
    }

    /**
     * @param $with array|string
     */
    private function getProductModel($with = 'images')
    {
        if (!is_array($with) && !is_null($with)) {
            $with = [$with];
        }
        return Product::query()->where('on_sale', 1)->with($with);
    }

    /**
     * 获取某篇文章的所有评论
     * @param Product $product
     * @return array
     */
    private function getCommentByProduct(Product $product): array
    {
        $comments = [];
        $product->comments()->get()->map(function ($comment) use (&$comments) {
            if (!is_null($comment['review']) && !is_null($comment['reviewed_at'])) {
                array_push($comments, [
                    'price' => $comment['price'],
                    'quantity' => $comment['quantity'],
                    'rating' => $comment['rating'],
                    'review' => $comment['review'],
                    'reviewed_at' => $comment['reviewed_at'],
                    'username'=>$comment->order->user->name
                ]);
            }
        });
        return $comments;
    }
}
