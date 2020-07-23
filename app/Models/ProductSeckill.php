<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductSeckill extends Model
{
    protected $table = 'products_seckill';

    public $timestamps = false;

    protected $dates = [
        'start_at', 'end_at'
    ];

    protected $appends=[
        'isStart','isOver'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    #秒杀是否开始
    public function getIsStartAttribute()
    {
        return $this->start_at->lt(Carbon::now());
    }

    #秒杀是否结束
    public function getIsOverAttribute()
    {
        return $this->end_at->lt(Carbon::now());
    }
}
