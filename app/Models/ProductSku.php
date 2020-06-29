<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'description', 'price', 'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function addStock($quantity = 1)
    {
        return $this->where('id', $this->id)->increment('stock',$quantity);
    }

    public function subtractStock($quantity = 1)
    {
        return $this->where('id', $this->id)->where('stock', '>', 0)->decrement('stock',$quantity);
    }
}
