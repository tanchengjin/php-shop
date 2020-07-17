<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'price','quantity','review','paid_at','rating','reviewed_at'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id', 'id');
    }


    public function getHashIdAttribute()
    {
        return hashids_order_id($this->attributes['id']);
    }
}
