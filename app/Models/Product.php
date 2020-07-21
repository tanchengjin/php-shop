<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'review_count', 'sold_count', 'ratting', 'on_sale', 'price'
    ];

    protected $appends = [
        'isWishlist','firstImage','secondImage'
    ];
    protected $casts = [
        'tags' => 'array'
    ];


    public const TAB_SALE = 'sale';
    public const TAB_NEW = 'new';
    public const TAB_HOT = 'hot';
    public static $tabsMap = [
        self::TAB_SALE => '促销商品',
        self::TAB_NEW => '新商品',
        self::TAB_HOT => '热门商品'

    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function skus()
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function getFirstImageAttribute()
    {
        try {
            if ($image = $this->images()->first()) {
                return $image['url'];
            }
        } catch (\Exception $exception) {

        }
        return asset('assets/images/error.png');
    }

    public function getSecondImageAttribute()
    {
        try {
            if ($image = $this->images()->get()[1]) {
                return $image['url'];
            }
        } catch (\Exception $exception) {

        }
        return asset('assets/images/error.png');
    }

    //判断当前商品是否被当前用户收藏
    public function getIsWishlistAttribute()
    {
        if (Auth::check()) {
            return Auth::user()->wishlist()->where('product_id', $this->id)->exists();
        }
        return false;
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'product_id', 'id');
    }

    #关联所有评论
    public function comments()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }
}
