<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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

        if (!$product = Product::query()->where('on_sale', 1)->find($id)) {
            abort(404);
        }

        #相关商品
        $product_relate = Product::query()->where('on_sale', 1)->where(function ($query) use ($product) {
            $query->where('category_id', $product->category_id)->orWhere('title', 'like', '%' . $product->title . '%');
        })->orderBy('created_at', 'desc')->limit(9)->get();

        #促销商品
        $product_sale = Product::query()->where('on_sale', 1)->where('tags', 'like', '%sale%')->limit(9)->get();

        $product->with(['skus', 'images']);
        return view('products.show', [
            'product' => $product,
            'product_relate' => $product_relate,
            'product_sale' => $product_sale,
        ]);
    }
}
