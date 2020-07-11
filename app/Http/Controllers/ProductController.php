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

        //排序
        if ($order = $request->input('order')) {

        }

        if (($min_price = $request->get('price_range_min')) >= 0) {

            if (($max_price = $request->get('price_range_max')) > $min_price) {
                $builder->whereBetween('price', [$min_price, $max_price]);
            }
        }

        $products = $builder->paginate(20);

        return view('products.index', [
            'products' => $products,
            'range_price_min' => $min_price ?? false,
            'range_price_max' => $max_price ?? false,
            'categoryTree'=>(new Category())->getCategoryTree(),
        ]);
    }

    public function show($id)
    {
        if (!$product = Product::query()->where('on_sale', 1)->find($id)) {
            abort(404);
        }
        $product->with(['skus', 'images']);
        return view('products.show', [
            'product' => $product,
        ]);
    }
}
