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
        $builder = Product::query()->where('on_sale', 1)->with(['skus', 'images']);

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
                $builder->whereHas('category', function ($query) use ($category) {
                    $query->where('path', 'like', $category->path . $category->id . '-%');
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
            'categoryTree' => (new Category())->getCategoryTree(),
            'param' => [
                'order' => $order,
                'search' => $search
            ],
        ]);
    }

    public function show($id)
    {
        $redisKey = 'product:show:' . $id;
        if (!$product = $this->getRedisByKey($redisKey)) {
            if (!$product = Product::query()->where('on_sale', 1)->with(['images', 'skus'])->find($id)) {
                abort(404);
            }
            $this->setRedisByKey($redisKey, $product);
        }

        #相关商品
        $relateRedisKey = 'product:relate';
        if (!$product_relate = $this->getRedisByKey($relateRedisKey)) {
            $product_relate = Product::query()->where('on_sale', 1)->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)->orWhere('title', 'like', '%' . $product->title . '%');
            })->orderBy('created_at', 'desc')->limit(9)->get()->load('images');
            $this->setRedisByKey($relateRedisKey, $product_relate);
        }
        #促销商品
        $saleRedisKey = 'product:sale';
        if (!$product_sale = $this->getRedisByKey($saleRedisKey)) {
            $product_sale = Product::query()->where('on_sale', 1)
                ->where('tags', 'like', '%sale%')
                ->with('images')->limit(9)
                ->get();
            $this->setRedisByKey($saleRedisKey, $product_sale);
        }
        return view('products.show', [
            'product' => $product,
            'product_relate' => $product_relate,
            'product_sale' => $product_sale,
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
}
