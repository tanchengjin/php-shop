<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title','description','review_count','sold_count','ratting','on_sale','price'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function skus()
    {
        return $this->hasMany(ProductSku::class,'product_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function getFirstImageAttribute()
    {
        if($image=$this->images()->first()){
            return $image;
        }else{
            return asset('assets/images/error.png');
        }
    }
}
