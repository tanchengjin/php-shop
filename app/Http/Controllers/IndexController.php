<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Support;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        #获取banner图
        $banners = Banner::query()->orderBy('order', 'desc')->where('enable', 1)->get();


        $supports = Support::query()->orderBy('order', 'desc')->where('enable', 1)->get();

        #合作伙伴，品牌
        $partners = Partner::query()->orderBy('order', 'desc')->where('enable', 1)->get();;

        #最近文章
        $recentBlogs = Blog::query()->where('enable', 1)->orderBy('created_at', 'desc')->limit(5)->get();

        #访问最多的商品
        $mostViewProduct = $this->getProductModel()->orderBy('click', 'desc')->limit(12)->get();

        #推荐商品
        $recommendProduct = $this->getProductModel()->orderBy('id', 'desc')->limit(12)->get()->load('images');

        #最好的商品
        $bestProduct = $this->getProductModel()->orderBy('id', 'desc')->limit(12)->get()->load('images');

        return view('index.index', [
            'banners' => $banners,
            'supports' => $supports,
            'partners' => $partners,
            'recentBlogs' => $recentBlogs,
            'newProduct' => $this->getProductDataByTag('new'),
            'hotProduct' => $this->getProductDataByTag('hot'),
            'saleProduct' => $this->getProductDataByTag('sale'),
            'mostViewProduct' => $mostViewProduct,
            'recommendProduct' => $this->format_row_3($recommendProduct->toArray()),
            'bestProduct' => $bestProduct,
        ]);
    }

    private function getProductDataByTag($tag, $limit = 12)
    {
        $res = [];
        $data = Product::query()->where('on_sale', 1)
            ->where('tags', 'like', '%' . $tag . '%')
            ->orderBy('order', 'desc')
            ->limit($limit)
            ->get()->load('images');

        foreach ($data as $index => $item) {
            static $key = 0;
            if ($index % 2 === 0) {
                $res[$key]['top'] = $item->toArray();
            } else {
                $res[$key]['bottom'] = $item->toArray();
                ++$key;
            }
        }
        return $res;
    }

    private function getProductModel()
    {
        return Product::query()->where('on_sale', 1);
    }

    /**
     * 转换格式
     * ---
     * |x|
     * ---
     * |x|
     * ---
     * |x|
     */
    private function format_row_3(array $data)
    {
        $arr = [];
        static $k = 0;
        foreach ($data as $index => $item) {
            if (!isset($arr[$k])) {
                $arr[$k]['top'] = $item;
                continue;
            }

            switch (count($arr[$k])) {
                case 1:
                    $arr[$k]['middle'] = $item;
                    break;
                case 2:
                    $arr[$k]['bottom'] = $item;
                    ++$k;
                    break;
            }
        }
        return $arr;
    }
}
