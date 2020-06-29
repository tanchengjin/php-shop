<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps=false;


    public function sku()
    {
        return $this->belongsTo(ProductSku::class,'product_sku_id','id');
    }

}
