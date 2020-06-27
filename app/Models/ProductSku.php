<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'title','description','price','stock'
    ];
}
