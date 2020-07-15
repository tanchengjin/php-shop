<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable=[
        'key','value'
    ];
    public $timestamps=false;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
