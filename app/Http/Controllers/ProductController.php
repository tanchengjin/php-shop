<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $builder = Product::query()->where('on_sale', 1)->with(['skus','images']);

        //排序
        if ($order = $request->input('order')) {

        }
        $products = $builder->paginate(9);
        return view('products.index', ['products' => $products]);
    }

    public function show($id)
    {
        if (!$product = Product::query()->where('on_sale', 1)->find($id)) {
            abort(404);
        }
        $product->with(['skus','images']);
        return view('products.show', [
            'product'=>$product
        ]);
    }
}
