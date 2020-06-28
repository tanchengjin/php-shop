<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    protected $fillable = ['quantity'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id', 'id');
    }

}
