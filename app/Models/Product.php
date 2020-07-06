<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'review_count', 'sold_count', 'ratting', 'on_sale', 'price'
    ];

    protected $appends=[
        'isWishlist'
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
        if ($image = $this->images()->first()) {
            return $image;
        } else {
            return asset('assets/images/error.png');
        }
    }
    //判断当前商品是否被当前用户收藏
    public function getIsWishlistAttribute()
    {
        if (Auth::check()){
            return Auth::user()->wishlist()->where('product_id',$this->id)->exists();
        }
        return false;
    }
}
