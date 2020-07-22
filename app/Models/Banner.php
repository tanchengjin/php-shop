<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'subtitle', 'content', 'image', 'url'
    ];

    #banner url跳转类型
    const URL_PRODUCT = 'product';
    const URL_WEB = 'web';
    public static $urlMap = [
        self::URL_PRODUCT => '本站商品跳转',
        self::URL_WEB => '互联网跳转'
    ];
    protected $appends = [
        'full_image'
    ];

    #Banner广告位类型
    const BANNER_TYPE_INDEX = 'index';
    const BANNER_TYPE_INDEX_LR = 'ilr';
    const BANNER_TYPE_INDEX_FI = 'ifi';
    const BANNER_TYPE_INDEX_BI = 'ibi';
    public static $bannerMap = [
        self::BANNER_TYPE_INDEX => '首页轮播图(1423x386像素)',
        self::BANNER_TYPE_INDEX_LR => '首页左右广告位(540x190像素)',
        self::BANNER_TYPE_INDEX_FI => '首页横幅广告位(1920x440像素)',
        self::BANNER_TYPE_INDEX_BI => '首页下方优质商品左侧广告位(350x432像素)',
    ];

    public function getFullImageAttribute()
    {
        return set_full_image($this->attributes['image']);
    }
}
