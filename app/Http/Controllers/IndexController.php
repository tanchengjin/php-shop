<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Partner;
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
        return view('index.index', [
            'banners' => $banners,
            'supports' => $supports,
            'partners' => $partners
        ]);
    }
}
