<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Support;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        #获取banner图
        $bannerData = $this->getBannerModel()->get();
        $banners = $bannerData->where('banner_type', Banner::BANNER_TYPE_INDEX);
        #首页左右两侧广告位
        $banner_lr = $this->getBannerModel()->where('banner_type', Banner::BANNER_TYPE_INDEX_LR)->limit(2)->get();
        #首页中部完整广告位
        $banner_fi = $bannerData->where('banner_type', Banner::BANNER_TYPE_INDEX_FI)->first();
        #首页优质商品处左侧广告位
        $banner_bi = $bannerData->where('banner_type', Banner::BANNER_TYPE_INDEX_BI)->first();

        $supports = Support::query()->orderBy('order', 'desc')->where('enable', 1)->get();

        #合作伙伴，品牌
        $partners = Partner::query()->orderBy('order', 'desc')->where('enable', 1)->get();;

        #最近文章
        $recentBlogs = Blog::query()->where('enable', 1)->orderBy('created_at', 'desc')->limit(5)->get();

        #访问最多的商品
        $mostViewProduct = $this->getProductModel()->orderBy('click', 'desc')->limit(12)->get();

        #推荐商品
        $recommendProduct = $this->getProductModel()->orderBy('id', 'desc')->limit(12)->get()->load('images');

        #优质商品
        $bestProduct = $this->getProductModel()->orderBy('rating', 'desc')->limit(12)->get()->load('images');

        #秒杀商品
        $seckillProduct=$this->getProductModel(Product::TYPE_SECKILL)->orderBy('order','desc')->orderBy('created_at','desc')->limit(12)->get()->load('seckill');

        return view('index.index', [
            'banners' => $banners,
            'supports' => $supports,
            'partners' => $partners,
            'recentBlogs' => $recentBlogs,
            'newProduct' => $this->getProductDataByTag('new'),
            'hotProduct' => $this->getProductDataByTag('hot'),
            'saleProduct' => $this->getProductDataByTag('sale'),
            'mostViewProduct' => $mostViewProduct,
            'recommendProduct' => $this->format_col_row3($recommendProduct->toArray()),
            'bestProduct' => $this->format_col_row3($bestProduct->toArray()),
            'banner_lr'=>$banner_lr,
            'banner_fi'=>$banner_fi,
            'banner_bi'=>$banner_bi,
            'seckillProduct'=>$seckillProduct
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

    private function getProductModel($type=null)
    {
        if (is_null($type)){
            $type=Product::TYPE_NORMAL;
        }
        return Product::query()->where('on_sale', 1)->where('type',$type);
    }

    /**
     * 转换格式,以列为格式，一列中有3行数据
     * ---
     * |x|
     * ---
     * |x|
     * ---
     * |x|
     */
    private function format_col_row3(array $data)
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

    private function getBannerModel()
    {
        return Banner::query()->where('enable', 1)->orderBy('order', 'desc');
    }
}
